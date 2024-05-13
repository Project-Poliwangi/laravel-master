<?php

namespace Modules\Monitoring\Http\Controllers;

use App\Models\Core\Unit;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Modules\Monitoring\Entities\Perencanaan;
use Modules\Monitoring\Entities\Realisasi;
use Modules\Monitoring\Entities\SubPerencanaan;

class MonitoringController extends Controller
{
    public function index()
    {
        $perencanaan = Perencanaan::all();
        $unit = Unit::all();
        $realisasi = Realisasi::all();
        $labels = [];
        $data = [];
        $total = 0;

        foreach ($unit as $unit) {
            $labels[] = $unit->nama;
        }

        foreach ($perencanaan as $value) {
            $total = 0;
            foreach ($value->subPerencanaan as $sub) {
                $total += $sub->volume * $sub->harga_satuan;
            }
    
            $data[] = $total;
        }

        // dd($labels);
        return view('monitoring::index', compact('perencanaan'))
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
