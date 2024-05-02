<?php

namespace Modules\Monitoring\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Monitoring\Entities\Perencanaan;
use Modules\Monitoring\Entities\Realisasi;
use Modules\Monitoring\Entities\SubPerencanaan;

class RealisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $jumlahProgramKerja = SubPerencanaan::count();
        $realisasi = Realisasi::whereHas('subPerencanaan.realisasi')->get();
        $perencanaan = Perencanaan::all();
        $totalDPA = 0;

        foreach ($perencanaan as $item) {
            $subPerencanaan = $item->subPerencanaan;
            foreach ($subPerencanaan as $sub) {
                $totalDPA += ($sub->volume * $sub->harga_satuan);
            }
        }
        
        return view('monitoring::realisasi.index', compact('perencanaan', 'realisasi', 'jumlahProgramKerja', 'totalDPA'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('monitoring::realisasi.create');
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
        return view('monitoring::realisasi.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('monitoring::realisasi.edit');
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
