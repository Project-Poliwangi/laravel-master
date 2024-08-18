<?php

namespace Modules\PeminjamanRuangan\Http\Controllers\Ruang;

use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\PeminjamanRuangan\Entities\Gedung;
use Modules\PeminjamanRuangan\Entities\Pegawai;
use Modules\PeminjamanRuangan\Entities\MataKuliah;
use Modules\PeminjamanRuangan\Entities\ProgramStudi;
use Modules\PeminjamanRuangan\Entities\Ruang;
use Modules\PeminjamanRuangan\Entities\RuangPenggunaanKuliah;

class RuangController extends Controller
{
    public function checkRuangan()
    {
        $data = [
            'title' => 'Cek Ruangan'
        ];

        return view('peminjamanruangan::ruang.cek-ruangan', $data);
    }

    public function checkKodeQR($kode)
    {
        $ruang = Ruang::whereKodeQr($kode)->first();

        $check = Ruang::whereHas('ruangPenggunaanKuliah', function($q) use ($ruang) {
            $date = Carbon::now();
            $q->whereStatus('approve');
            $q->whereDate('jadwal_mulai', $date->format('Y-m-d'));
            $q->whereTime('jadwal_mulai', '<=', $date->format('H:i:s'));
            $q->whereTime('jadwal_akhir', '>=', $date->format('H:i:s'));
            $q->whereRuangId($ruang->id);
        })->whereKodeQr($kode);

        if(!is_null($ruang)) {
            if(isset($ruang->ruangPenggunaanKuliah[0])) {
                $ruang->ruangPenggunaanKuliah[0]->jadwal_mulai = Carbon::parse($ruang->ruangPenggunaanKuliah[0]->jadwal_mulai)->format('d M Y');
                $ruang->ruangPenggunaanKuliah[0]->jadwal_akhir = Carbon::parse($ruang->ruangPenggunaanKuliah[0]->jadwal_akhir)->format('d M Y');
                $ruang->ruangPenggunaanKuliah[0]->waktu_pinjam = Carbon::parse($ruang->ruangPenggunaanKuliah[0]->waktu_pinjam)->format('H.i');
                $ruang->ruangPenggunaanKuliah[0]->waktu_selesai = Carbon::parse($ruang->ruangPenggunaanKuliah[0]->waktu_selesai)->format('H.i');
            }

            $data = [
                'title' => 'Detail Ruangan',
                'status' => $check->count() > 0,
                'ruang' => $ruang
            ];

            return view('peminjamanruangan::ruang.detail-ruangan', $data);
        } else {
            return redirect()->route('ruang.check')->withErrors(['kode' => 'Kode QR tidak valid!']);
        }
    }

    public function ruanganTersedia(Request $request)
    {
        if($request->has('date')) {
            $date = Carbon::parse($request->date .' '. $request->time);
        } else {
            $date = Carbon::now();
        }
        $dataRuangTerpakai = Ruang::whereHas('ruangPenggunaanKuliah', function($q) use ($date) {
            $q->whereStatus('approve');
            $q->whereDate('jadwal_mulai', '<=', $date->format('Y-m-d'));
            $q->whereDate('jadwal_akhir', '>=', $date->format('Y-m-d'));
        })->get();
        
        $dataRuangTerpakai = $dataRuangTerpakai->filter(function($value, $key) use ($date) {
            $jadwalMulai = Carbon::parse($value->ruangPenggunaanKuliah()->whereDate('jadwal_mulai', '<=', $date->format('Y-m-d'))->whereDate('jadwal_akhir', '>=', $date->format('Y-m-d'))->whereStatus('approve')->first()->jadwal_mulai);
            $jadwalAkhir = Carbon::parse($value->ruangPenggunaanKuliah()->whereDate('jadwal_mulai', '<=', $date->format('Y-m-d'))->whereDate('jadwal_akhir', '>=', $date->format('Y-m-d'))->whereStatus('approve')->first()->jadwal_akhir);

            return $jadwalMulai->timestamp <= $date->timestamp && $jadwalAkhir->timestamp >= $date->timestamp;
        })->pluck('id')->all();

        $ruang = Ruang::query();

        if($request->has('search') && $request->search != '') {
            $ruang = $ruang->where('nama', 'like', '%'.$request->search.'%');
        }

        if($request->has('gedung_id') && $request->gedung_id != '') {
            $ruang = $ruang->where('gedung_id', $request->gedung_id);
        }
        
        $ruang = $ruang->whereNotIn('id', $dataRuangTerpakai)->get();

        $data = [
            'title' => 'Ruangan Tersedia',
            'ruangs' => $ruang,
            'gedungs' => Gedung::all(),
            'gedung_id' => $request->has('gedung_id') ? $request->gedung_id : '',
            'search' => $request->has('search') ? $request->search : '',
            'date' => $request->date,
        ];

        return view('peminjamanruangan::ruang.daftar-ruangan', $data);
    }

    public function ruanganTerpakai(Request $request)
    {
        $ruang = Ruang::query();

        if($request->has('search') && $request->search != '') {
            $ruang = $ruang->where('nama', 'like', '%'.$request->search.'%');
        }

        if($request->has('gedung_id') && $request->gedung_id != '') {
            $ruang = $ruang->where('gedung_id', $request->gedung_id);
        }

        if($request->has('date')) {
            $date = Carbon::parse($request->date);
        } else {
            $date = Carbon::now();
        }
        
        $ruang = $ruang->whereHas('ruangPenggunaanKuliah', function($query) use ($date) {
            $query->whereStatus('approve');
            $query->whereDate('jadwal_mulai', '<=', $date->format('Y-m-d'));
            $query->whereDate('jadwal_akhir', '>=', $date->format('Y-m-d'));
        })->get();

        $ruang = $ruang->filter(function($value, $key) use ($date) {
            $jadwalMulai = Carbon::parse($value->ruangPenggunaanKuliah()->whereDate('jadwal_mulai', '<=', $date->format('Y-m-d'))->whereDate('jadwal_akhir', '>=', $date->format('Y-m-d'))->whereStatus('approve')->first()->jadwal_mulai);
            $jadwalAkhir = Carbon::parse($value->ruangPenggunaanKuliah()->whereDate('jadwal_mulai', '<=', $date->format('Y-m-d'))->whereDate('jadwal_akhir', '>=', $date->format('Y-m-d'))->whereStatus('approve')->first()->jadwal_akhir);

            return $jadwalMulai->timestamp <= $date->timestamp && $jadwalAkhir->timestamp >= $date->timestamp;
        });

        $ruang->map(function($value, $key) use ($date) {
            $value->nama_user = $value->ruangPenggunaanKuliah()->whereDate('jadwal_mulai', '<=', $date->format('Y-m-d'))->whereDate('jadwal_akhir', '>=', $date->format('Y-m-d'))->whereStatus('approve')->first()->user->name;
            $value->email_user = $value->ruangPenggunaanKuliah()->whereDate('jadwal_mulai', '<=', $date->format('Y-m-d'))->whereDate('jadwal_akhir', '>=', $date->format('Y-m-d'))->whereStatus('approve')->first()->user->email;
            $value->username_user = $value->ruangPenggunaanKuliah()->whereDate('jadwal_mulai', '<=', $date->format('Y-m-d'))->whereDate('jadwal_akhir', '>=', $date->format('Y-m-d'))->whereStatus('approve')->first()->user->username;
            $value->peminjam_nim = $value->ruangPenggunaanKuliah()->whereDate('jadwal_mulai', '<=', $date->format('Y-m-d'))->whereDate('jadwal_akhir', '>=', $date->format('Y-m-d'))->whereStatus('approve')->first()->peminjam_nim;

            return $value;
        });

        $data = [
            'title' => 'Ruangan Terpakai',
            'type' => 'terpakai',
            'ruangs' => $ruang,
            'gedungs' => Gedung::all(),
            'date' => $request->date,
            'gedung_id' => $request->has('gedung_id') ? $request->gedung_id : '',
            'search' => $request->has('search') ? $request->search : ''
        ];

        return view('peminjamanruangan::ruang.daftar-ruangan', $data);
    }

    public function detailRuangan(Ruang $ruang)
    {
        $check = Ruang::whereHas('ruangPenggunaanKuliah', function($q) use ($ruang) {
            $date = Carbon::now();
            $q->whereStatus('approve');
            $q->whereDate('jadwal_mulai', $date->format('Y-m-d'));
            $q->whereTime('jadwal_mulai', '<=', $date->format('H:i:s'));
            $q->whereTime('jadwal_akhir', '>=', $date->format('H:i:s'));
            $q->whereRuangId($ruang->id);
        });


        $data = [
            'title' => 'Detail Ruangan ',
            'status' => $check->count() > 0,
            'ruang' => $ruang,
        ];

        return view('peminjamanruangan::ruang.detail-ruangan', $data);
    }

    public function createPeminjaman(Ruang $ruang)
    {
        $data = [
            'title' => 'Form Pinjam Ruangan',
            'ruangs' => Ruang::all(),
            'programStudis' => ProgramStudi::all(),
            'mataKuliahs' => MataKuliah::all(),
            'pegawais' => Pegawai::all(),
            'value' => $ruang
        ];

        return view('peminjamanruangan::ruang.form-peminjaman', $data);
    }

    public function storePeminjaman(Request $request)
    {
        $request->validate([
            'ruang_id' => 'required',
            'program_studi_id' => 'required',
            'mata_kuliah_id' => 'required',
            'dosen_id' => 'required',
            'jadwal_mulai' => 'required',
            'jadwal_akhir' => 'required',
            'nim' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
        ]);

        try {
            $inputTime = Carbon::createFromFormat('Y-m-d H:i', $request->jadwal_mulai .' '. $request->waktu_mulai);
            $currentTime = Carbon::now();

            // check jadwal peminjaman harus lebih dari tanggal atau waktu sekarang
            if(!$inputTime->gt($currentTime)) {
                return redirect()->back()->with('error', 'Peminjaman ruangan harus lebih dari tanggal atau waktu sekarang')->withInput();
            }

            // check ketersediaan ruangan
            $check = Ruang::whereHas('ruangPenggunaanKuliah', function($q) use ($request) {
                $dateStart = Carbon::createFromFormat('Y-m-d H:i', $request->jadwal_mulai .' '. $request->waktu_mulai);
                $dateEnd = Carbon::createFromFormat('Y-m-d H:i', $request->jadwal_akhir .' '. $request->waktu_selesai);

                // $q->whereStatus('approve');
                $q->whereDate('jadwal_mulai', $dateStart->format('Y-m-d'));
                $q->whereTime('jadwal_mulai', '<=', $dateStart->format('H:i:s'));
                $q->whereTime('jadwal_akhir', '>=', $dateEnd->format('H:i:s'));
                $q->whereRuangId($request->ruang_id);
            });

            if($check->count() > 0) {
                return redirect()->back()->with('error', 'Ruangan Tidak Tersedia di tanggal atau waktu yang dipilih')->withInput();
            }

            $request->merge([
                'jadwal_mulai' => Carbon::createFromFormat('Y-m-d H:i', $request->jadwal_mulai .' '. $request->waktu_mulai)->format('Y-m-d H:i:s'), 
                'waktu_pinjam' => Carbon::createFromFormat('Y-m-d H:i', $request->jadwal_mulai .' '. $request->waktu_mulai)->format('Y-m-d H:i:s'), 
                'jadwal_akhir' => Carbon::createFromFormat('Y-m-d H:i', $request->jadwal_akhir .' '. $request->waktu_selesai)->format('Y-m-d H:i:s'), 
                'waktu_selesai' => Carbon::createFromFormat('Y-m-d H:i', $request->jadwal_akhir .' '. $request->waktu_selesai)->format('Y-m-d H:i:s'), 
                'peminjam_nim' => $request->nim,
                'foto_selesai' => null,
                'user_id' => auth()->user()->id
            ]);
            RuangPenggunaanKuliah::create($request->only('ruang_id', 'program_studi_id', 'mata_kuliah_id', 'dosen_id', 'jadwal_mulai', 'jadwal_akhir', 'peminjam_nim', 'waktu_pinjam', 'waktu_selesai', 'foto_selesai', 'user_id'));

            return redirect()->route('peminjaman')->with('success', 'Peminjaman Ruangan Berhasil');
        } catch(Exception $e) {
            echo response()->json($e);
        }
    }
}
