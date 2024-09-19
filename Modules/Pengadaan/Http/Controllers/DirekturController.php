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
use Modules\Pengadaan\Entities\MetodePengadaan;

class DirekturController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // Mengimpor Carbon untuk mendapatkan tahun saat ini
        $currentYear = Carbon::now()->year;
    
        // Menghitung total pengadaan
        $totalPengadaan = Pengadaan::count();
    
        // Menghitung pengadaan baru dalam tahun ini
        $pengadaanBaru = Pengadaan::whereYear('created_at', $currentYear)->count();
    
        // Menghitung pengadaan yang selesai dalam tahun ini
        $pengadaanSelesai = Pengadaan::where('status_id', 4) // Status 4 untuk "Selesai"
            ->whereYear('updated_at', $currentYear)
            ->count();
    
        // Mengambil semua jenis pengadaan, status pengadaan, dan metode pengadaan
        $jenisPengadaans = JenisPengadaan::all();
        $pengadaanStatuses = Status::all();
        $metodePengadaans = MetodePengadaan::all();
    
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
    
        // Menghitung jumlah pengadaan berdasarkan metode
        $metodePengadaanData = SubPerencanaan::select('metode_pengadaan_id')
            ->selectRaw('count(*) as count')
            ->groupBy('metode_pengadaan_id')
            ->get()
            ->pluck('count', 'metode_pengadaan_id');
    
        // Memastikan setiap jenis pengadaan ada dalam data, meskipun nilainya nol
        $jenisPengadaanChart = $jenisPengadaans->map(function($jenis) use ($jenisPengadaanData) {
            return [
                'label' => $jenis->nama_jenis,
                'count' => $jenisPengadaanData->get($jenis->id, 0),
            ];
        });
    
        // Memastikan setiap status pengadaan ada dalam data, meskipun nilainya nol
        $pengadaanStatusChart = $pengadaanStatuses->map(function($status) use ($pengadaanStatusData) {
            return [
                'label' => $status->nama_status,
                'count' => $pengadaanStatusData->get($status->id, 0),
            ];
        });
    
        // Memastikan setiap metode pengadaan ada dalam data, meskipun nilainya nol
        $metodePengadaanChart = $metodePengadaans->map(function($metode) use ($metodePengadaanData) {
            return [
                'label' => $metode->nama_metode,
                'count' => $metodePengadaanData->get($metode->id, 0),
            ];
        });
    
        // Mengirimkan data ke view
        return view('pengadaan::direktur.dashboard', compact(
            'jenisPengadaanChart',
            'pengadaanStatusChart',
            'metodePengadaanChart',
            'totalPengadaan',
            'pengadaanBaru',
            'pengadaanSelesai'
        ));
    }    


    public function daftarpengadaan(Request $request)
    {
        // Mengambil semua data pengadaan
        $subPerencanaan = SubPerencanaan::all();
        $status = Status::all();

        return view('pengadaan::direktur.daftarpengadaan', compact('subPerencanaan', 'status'));
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
        $subPerencanaan = SubPerencanaan::with(['perencanaan', 'pengadaan'])->find($id);
        if (!$subPerencanaan) {
            return response()->json(['message' => 'SubPerencanaan tidak ditemukan'], 404);
        }

         // Ambil Pengadaan berdasarkan ID SubPerencanaan
         $pengadaan = Pengadaan::where('subperencanaan_id', $id)->first();

         // Status default jika tidak ada dalam database
         $status = 0; // Misalnya status 0 untuk 'Belum Dalam Periode'
 
         // Cek status yang ada di database
         if ($pengadaan && $pengadaan->status_id && in_array($pengadaan->status_id, [1, 2, 3, 4])) {
             $status = $pengadaan->status_id;
         }

        return view('pengadaan::direktur.show', compact('subPerencanaan', 'status'));
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
