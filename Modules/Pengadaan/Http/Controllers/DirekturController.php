<?php

namespace Modules\Pengadaan\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Pengadaan\Entities\Unit;
use Modules\Pengadaan\Entities\Status;
use Modules\Pengadaan\Entities\Pengadaan;
use Illuminate\Contracts\Support\Renderable;
use Modules\Pengadaan\Entities\JenisPengadaan;
use Modules\Pengadaan\Entities\SubPerencanaan;

class DirekturController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // RINGKASAN TOTAL PENGADAAN
        // Mendapatkan tahun saat ini
        $currentYear = Carbon::now()->year;

        // Menghitung total pengadaan
        $totalPengadaan = Pengadaan::count();

        // Menghitung pengadaan baru dalam tahun ini
        $pengadaanBaru = Pengadaan::whereYear('created_at', $currentYear)->count();

        // Menghitung pengadaan yang selesai dalam tahun ini
        $pengadaanSelesai = Pengadaan::where('status_id', 5) // Status 5 untuk "Serah Terima"
            ->whereYear('updated_at', $currentYear)
            ->count();

        // Mengambil semua jenis pengadaan
        $jenisPengadaans = JenisPengadaan::all();
        // Mengambil semua status pengadaan
        $pengadaanStatuses = Status::all();

        // Menghitung jumlah pengadaan berdasarkan jenis
        $jenisPengadaanData = SubPerencanaan::select('jenis_pengadaan_id')
            ->selectRaw('count(*) as count')
            ->groupBy('jenis_pengadaan_id')
            ->get()
            ->pluck('count', 'jenis_pengadaan_id');

        // Menghitung jumlah pengadaan berdasarkan status
        $pengadaanStatusData = Pengadaan::select('status_id')
            ->selectRaw('count(*) as count')
            ->groupBy('status_id')
            ->get()
            ->pluck('count', 'status_id');

        // Memastikan setiap jenis pengadaan ada dalam data, meskipun nilainya nol
        $jenisPengadaanChart = [];
        foreach ($jenisPengadaans as $jenis) {
            $jenisPengadaanChart[] = [
                'label' => $jenis->nama_jenis,
                'count' => $jenisPengadaanData->get($jenis->id, 0),
            ];
        }

        // Memastikan setiap status pengadaan ada dalam data, meskipun nilainya nol
        $pengadaanStatusChart = [];
        foreach ($pengadaanStatuses as $status) {
            $pengadaanStatusChart[] = [
                'label' => $status->nama_status,
                'count' => $pengadaanStatusData->get($status->id, 0),
            ];
        }

        // Mengambil semua unit pengadaan beserta jumlah pengadaan melalui sub_perencanaan
        // $units = Unit::with(['perencanaan.subperencanaan.pengadaan'])->get();

        // $unitNames = [];
        // $unitCounts = [];

        // foreach ($units as $unit) {
        //     $unitNames[] = $unit->nama;
        //     // Menghitung jumlah pengadaan untuk setiap unit
        //     $count = 0;
        //     if ($unit->perencanaan) {
        //         foreach ($unit->perencanaan as $perencanaan) {
        //             if ($perencanaan->subperencanaan) {
        //                 foreach ($perencanaan->subperencanaan as $subPerencanaan) {
        //                     if ($subPerencanaan->pengadaan) {
        //                         $count += $subPerencanaan->pengadaan->count();
        //                     }
        //                 }
        //             }
        //         }
        //     }
        //     $unitCounts[] = (int) $count; // Konversi ke integer
        // }

        return view('pengadaan::direktur.dashboard', compact('jenisPengadaanChart', 'pengadaanStatusChart', 'totalPengadaan', 'pengadaanBaru', 'pengadaanSelesai'));
    }


    public function daftarpengadaan(Request $request)
    {
        // Mengambil semua data pengadaan
        $pengadaans = Pengadaan::with(['subperencanaan.jenispengadaans', 'status'])->get();

        return view('pengadaan::direktur.daftarpengadaan', compact('pengadaans'));
    }

    public function permohonandiproses()
    {
        return view('pengadaan::direktur.permohonandiproses');
    }

    public function permohonanselesai()
    {
        return view('pengadaan::direktur.permohonanselesai');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('pengadaan::create');
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
        $subPerencanaan = SubPerencanaan::with(['perencanaans', 'pengadaan'])->find($id);
        if (!$subPerencanaan) {
            return response()->json(['message' => 'SubPerencanaan tidak ditemukan'], 404);
        }

        return view('pengadaan::direktur.show', compact('subPerencanaan'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('pengadaan::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
