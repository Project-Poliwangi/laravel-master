<?php

namespace Modules\PeminjamanRuangan\Http\Controllers\Peminjaman;

use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\PeminjamanRuangan\Entities\MataKuliah;
use Modules\PeminjamanRuangan\Entities\Pegawai;
use Modules\PeminjamanRuangan\Entities\ProgramStudi;
use Modules\PeminjamanRuangan\Entities\Ruang;
use Modules\PeminjamanRuangan\Entities\RuangPenggunaanKuliah;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $show = 10;
        if($request->has('show')) {
            $show = $request->show;
        }

        $query = RuangPenggunaanKuliah::query()->whereDate('jadwal_mulai', '>=', Carbon::today());

        if($request->has('search') && $request->search != '') {
            $query = $query->where('peminjam_nim', 'like', '%'.$request->search.'%')
                    ->orWhereHas('ruang', function($q) use ($request) {
                        $q->where('nama', 'like', '%'.$request->search.'%');
                        $q->orWhere('kode_bmn', 'like', '%'.$request->search.'%');
                    });
        }
        $dataPeminjaman = $query->paginate($show)->map(function($item) {
            $item->jadwal_mulai = Carbon::parse($item->jadwal_mulai)->format('d M Y') .', '. Carbon::parse($item->waktu_pinjam)->format('H:i') .' WIB';
            $item->jadwal_akhir = Carbon::parse($item->jadwal_akhir)->format('d M Y') .', '. Carbon::parse($item->waktu_selesai)->format('H:i') .' WIB';
            return $item;
        });

        $data = [
            'title' => 'Data Permohonan Anda',
            'show' => $show,
            'search' => $request->search,
            'data' => $dataPeminjaman,
            'paginate' => $query->paginate($show)
        ];

        return view('peminjamanruangan::peminjaman.index', $data);
    }

    public function edit(RuangPenggunaanKuliah $peminjaman)
    {
        $peminjaman->jadwal_mulai = Carbon::createFromFormat('Y-m-d H:i:s', $peminjaman->jadwal_mulai)->format('Y-m-d');
        $peminjaman->jadwal_akhir = Carbon::createFromFormat('Y-m-d H:i:s', $peminjaman->jadwal_akhir)->format('Y-m-d');
        $peminjaman->waktu_mulai = Carbon::createFromFormat('Y-m-d H:i:s', $peminjaman->waktu_pinjam)->format('H:i');
        $peminjaman->waktu_selesai = Carbon::createFromFormat('Y-m-d H:i:s', $peminjaman->waktu_selesai)->format('H:i');
        $data = [
            'title' => 'Edit Permohonan Peminjaman',
            'data' => $peminjaman,
            'ruangs' => Ruang::all(),
            'programStudis' => ProgramStudi::all(),
            'mataKuliahs' => MataKuliah::all(),
            'pegawais' => Pegawai::all(),
        ];

        return view('peminjamanruangan::peminjaman.form', $data);
    }

    public function update(Request $request, RuangPenggunaanKuliah $peminjaman)
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
            DB::beginTransaction();
            $inputTime = Carbon::createFromFormat('Y-m-d H:i', $request->jadwal_mulai .' '. $request->waktu_mulai);
            $currentTime = Carbon::now();

            // check jadwal peminjaman harus lebih dari tanggal atau waktu sekarang
            if(!$inputTime->gt($currentTime)) {
                return redirect()->back()->with('error', 'Peminjaman ruangan harus lebih dari tanggal atau waktu sekarang')->withInput();
            }

            // check ketersediaan ruangan
            $check = Ruang::whereHas('ruangPenggunaanKuliah', function($q) use ($request, $peminjaman) {
                $dateStart = Carbon::createFromFormat('Y-m-d H:i', $request->jadwal_mulai .' '. $request->waktu_mulai);
                $dateEnd = Carbon::createFromFormat('Y-m-d H:i', $request->jadwal_akhir .' '. $request->waktu_selesai);

                // $q->whereStatus('approve');
                $q->whereDate('jadwal_mulai', $dateStart->format('Y-m-d'));
                $q->whereTime('jadwal_mulai', '<=', $dateStart->format('H:i:s'));
                $q->whereTime('jadwal_akhir', '>=', $dateEnd->format('H:i:s'));
                $q->whereRuangId($request->ruang_id);
                $q->where('id', '!=', $peminjaman->id);
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
            ]);
            $peminjaman->update($request->only('ruang_id', 'program_studi_id', 'mata_kuliah_id', 'dosen_id', 'jadwal_mulai', 'jadwal_akhir', 'peminjam_nim', 'waktu_pinjam', 'waktu_selesai', 'foto_selesai'));
            DB::commit();

            return redirect()->route('peminjaman')->with('success', 'Permohonan berhasil diubah.');
        } catch(Exception $e) {
            echo response()->json($e);
        }
    }

    public function destroy(RuangPenggunaanKuliah $peminjaman)
    {
        try {
            $peminjaman->delete();
            return redirect()->route('peminjaman')->with('success', 'Permohonan berhasil di hapus');
        } catch(Exception $e) {
            echo response()->json($e->getMessage());
        }
    }

    public function upload(Request $request, RuangPenggunaanKuliah $peminjaman)
    {
        $request->validate([
            'bukti' => 'required|mimes:png,jpg,jpeg|max:2048',
        ]);

        try {
            DB::beginTransaction();
            $file = $request->file('bukti');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/images/uploads'), $fileName);
            $peminjaman->update([
                'foto_selesai' => $fileName
            ]);
            DB::commit();

            return redirect()->route('peminjaman')->with('success', 'Bukti peminjaman berhasil di upload');
        } catch(Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
