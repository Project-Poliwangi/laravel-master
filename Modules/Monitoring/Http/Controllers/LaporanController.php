<?php

namespace Modules\Monitoring\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Core\Unit;
use Carbon\Carbon;
use Modules\Monitoring\Entities\Perencanaan;
use Modules\Monitoring\Entities\Realisasi;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index_bulanan()
    {
        $perencanaan = Perencanaan::with('subPerencanaan')->get();
        $units = Unit::all();

        return view('monitoring::laporan_bulanan.index', compact('units', 'perencanaan'));
    }

    public function index_triwulan()
    {
        return view('monitoring::laporan_triwulan.index');
    }


    // Api chart
    public function ChartKeuangan()
    {
        $currentYear = Carbon::now()->year;
        $monthlyRealisasi = Realisasi::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(realisasi) as total_realisasi')
            ->whereYear('created_at', $currentYear)
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        $realisasi = collect();
        for ($i = 1; $i <= 12; $i++) {
            $realisasi->push([
                'month' => Carbon::create()->month($i)->format('F'),
                'total_realisasi' => $monthlyRealisasi->get($i)->total_realisasi ?? 0,
            ]);
        }
        return response()->json($realisasi);
    }
}
