<?php

namespace Modules\Pengadaan\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Pengadaan\Entities\Pengadaan;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $pengadaan = Pengadaan::where('nomor_surat', 'like', '%'.$search.'%')
                                ->orWhere('jenis_pengadaan', 'like', '%'.$search.'%')
                                ->orWhere('total_biaya', 'like', '%'.$search.'%')
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);

        return view('unit.index', compact('unit'));
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('pengadaan::unit.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'jenis_pengadaan' => 'required|in:barang,jasa,perbaikan,kegiatan,konstruksi',
            'total_biaya' => 'required|numeric|min:0',
            'dokumen_kak' => 'nullable|string|max:255',
            'dokumen_hps' => 'nullable|string|max:255',
            'dokumen_stock_opname' => 'nullable|string|max:255',
            'dokumen_surat_ijin_impor' => 'nullable|string|max:255',
            'status_id' => 'required|exists:status,id',
        ]);

        Pengadaan::create($validatedData);

        return response()->json(['message' => 'Pengadaan created successfully!']);
    }
    

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('pengadaan::show');
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

    public function daftarpermohonan()
    { 
        return view('pengadaan::unit.permohonan');
    }

    public function permohonandiproses()
    {
        return view('pengadaan::unit.diproses');
    }

    public function permohonanselesai()
    {
        return view('pengadaan::unit.selesai');
    }

    public function templatedokumen()
    {
        return view('pengadaan::unit.template');
    }
}
