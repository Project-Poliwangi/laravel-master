<?php

namespace Modules\PeminjamanRuangan\Http\Controllers\KelolaPeminjaman;

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

class KelolaPeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $show = 10;
        if($request->has('show')) {
            $show = $request->show;
        }

        $query = RuangPenggunaanKuliah::query()->whereDate('jadwal_mulai', '>=', Carbon::today());
        $ruangPenggunaanKuliah = $query->paginate($show)->map(function($item) {
            $item->jadwal_mulai = Carbon::parse($item->jadwal_mulai)->format('d M Y');
            $item->jadwal_akhir = Carbon::parse($item->jadwal_akhir)->format('d M Y');
            $item->waktu_pinjam = Carbon::parse($item->waktu_pinjam)->format('H:i');
            $item->waktu_selesai = Carbon::parse($item->waktu_selesai)->format('H:i');
            return $item;
        });

        $data = [
            'title' => 'Data Peminjam',
            'data' => $ruangPenggunaanKuliah,
            'show' => $show,
            'search' => $request->search,
            'paginate' => RuangPenggunaanKuliah::paginate($show)
        ];

        return view('peminjamanruangan::kelola-peminjaman.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('peminjamanruangan::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('peminjamanruangan::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
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

        return view('peminjamanruangan::kelola-peminjaman.form', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
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
            $peminjaman->update($request->only('ruang_id'));

            return redirect()->route('kelola-peminjaman')->with('success', 'Berhasil mengubah data');
        } catch(Exception $e) {
            echo response()->json($e);
        }
    }

    public function accept(RuangPenggunaanKuliah $peminjaman)
    {
        try {
            $peminjaman->update(['status' => 'approve']);
            return redirect()->route('kelola-peminjaman')->with('success', 'Berhasil mengubah data');
        } catch(Exception $e) {
            echo response()->json($e);
        }
    }

    public function reject(RuangPenggunaanKuliah $peminjaman)
    {
        try {
            $peminjaman->update(['status' => 'reject']);
            return redirect()->route('kelola-peminjaman')->with('success', 'Berhasil mengubah data');
        } catch(Exception $e) {
            echo response()->json($e);
        }
    }
}
