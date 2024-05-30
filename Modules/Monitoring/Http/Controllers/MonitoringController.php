<?php

namespace Modules\Monitoring\Http\Controllers;

use App\Models\Core\Unit;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Monitoring\Entities\Perencanaan;
use Modules\Monitoring\Entities\Realisasi;
use Modules\Monitoring\Entities\SubPerencanaan;

class MonitoringController extends Controller
{
    public function index()
    {
        $perencanaan = Perencanaan::with('subPerencanaan')->get();
        $realisasi = Realisasi::all();
        $units = Unit::paginate(4);
        $unitData = [];
        $labels = [];
        $data = [];

        // hitung total perencanaan
        $total_perencanaan = 0;
        foreach ($perencanaan as $item) {
            $subPerencanaan = $item->subPerencanaan;
            foreach ($subPerencanaan as $sub) {
                $total_perencanaan += $sub->volume * $sub->harga_satuan;
            }
        }

        // hitung total realisasi
        $total_realisasi = 0;
        foreach ($realisasi as $item) {
            $total_realisasi = $item->realisasi;
        }

        foreach ($perencanaan as $item) {
            $unit_id = $item->unit_id; // Get the unit_id from the Perencanaan
            if (!isset($unitData[$unit_id])) {
                $unitData[$unit_id] = 0; // Initialize the unit_id key if it does not exist
            }
            $subPerencanaan = $item->subPerencanaan;
            foreach ($subPerencanaan as $sub) {
                $unitData[$unit_id] += $sub->volume * $sub->harga_satuan;
            }
        }

        $persentase_perencanaan = ($total_perencanaan / ($total_perencanaan + $total_realisasi)) * 100;
        $persentase_realisasi = ($total_realisasi / ($total_perencanaan + $total_realisasi)) * 100;

        $data = [
            $persentase_perencanaan,
            $persentase_realisasi
        ];

        // \Log::info('Unit Data: ', $unitData);
        // dd($unitData);
        return view('monitoring::index', compact('perencanaan', 'units', 'unitData'))
            ->with('labels', $labels)
            ->with('data', $data);
    }

    public function create()
    {
        return view('monitoring::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('monitoring::show');
    }

    public function edit($id)
    {
        return view('monitoring::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
