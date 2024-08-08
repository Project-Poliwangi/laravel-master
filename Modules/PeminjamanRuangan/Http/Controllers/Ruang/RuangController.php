<?php

namespace Modules\PeminjamanRuangan\Http\Controllers\Ruang;

use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
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

    public function ruanganTersedia()
    {
        $dataRuangTerpakai = Ruang::whereHas('ruangPenggunaanKuliah', function($q) {
            $date = Carbon::now();
            $q->whereStatus('approve');
            $q->whereDate('jadwal_mulai', $date->format('Y-m-d'));
            $q->whereTime('jadwal_mulai', '<=', $date->format('H:i:s'));
            $q->whereTime('jadwal_akhir', '>=', $date->format('H:i:s'));
        })->pluck('id')->all();

        $data = [
            'title' => 'Ruangan Tersedia',
            'ruangs' => Ruang::whereNotIn('id', $dataRuangTerpakai)->get()
        ];

        return view('peminjamanruangan::ruang.daftar-ruangan', $data);
    }

    public function ruanganTerpakai()
    {
        $data = [
            'title' => 'Ruangan Terpakai',
            'type' => 'terpakai',
            'ruangs' => Ruang::whereHas('ruangPenggunaanKuliah', function($q) {
                $date = Carbon::now();
                $q->whereStatus('approve');
                $q->whereDate('jadwal_mulai', $date->format('Y-m-d'));
                $q->whereTime('jadwal_mulai', '<=', $date->format('H:i:s'));
                $q->whereTime('jadwal_akhir', '>=', $date->format('H:i:s'));
            })->get()
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
                'foto_selesai' => 'default.png',
            ]);
            RuangPenggunaanKuliah::create($request->only('ruang_id', 'program_studi_id', 'mata_kuliah_id', 'dosen_id', 'jadwal_mulai', 'jadwal_akhir', 'peminjam_nim', 'waktu_pinjam', 'waktu_selesai', 'foto_selesai'));

            return redirect()->route('peminjaman')->with('success', 'Peminjaman Ruangan Berhasil');
        } catch(Exception $e) {
            echo response()->json($e);
        }
    }
}
