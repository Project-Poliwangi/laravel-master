<?php

namespace Modules\Pengadaan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Pengadaan\Entities\Perencanaan;
use Illuminate\Contracts\Support\Renderable;

class PerencanaanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('pengadaan::index');
    }

    public function daftarperencanaan(Request $request)
    { 
        $perencanaans = Perencanaan::all();

        return view('pengadaan::perencanaan.perencanaan', compact('perencanaans'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $formMode = 'create';
        return view('pengadaan::perencanaan.create', compact('formMode'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:100',
            'sumber' => 'required|in:RM,Hibah,BOPTN,PNP,CF,PML',
            'revisi' => 'required|integer',
            'tahun' => 'required|integer',
        ]);

        Perencanaan::create($request->all());

        return redirect('/perencanaan/daftarperencanaan')->with('success_message', 'Perencanaan Pengadaan berhasil ditambahkan.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $perencanaans = Perencanaan::findOrFail($id);
        return view('pengadaan::perencanaan.show', compact('perencanaans'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $perencanaan = Perencanaan::findOrFail($id); // Menggunakan singular untuk satu item
        $formMode = 'edit';

        return view('pengadaan::perencanaan.edit', compact('perencanaan'))->with('formMode', 'edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {

        $perencanaans = Perencanaan::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:100',
            'sumber' => 'required|in:RM,Hibah,BOPTN,PNP,CF,PML',
            'revisi' => 'required|integer',
            'tahun' => 'required|integer',
        ]);

        $perencanaans->update($validatedData);

        return redirect('/perencanaan/daftarperencanaan')->with('success_message', 'Perencanaan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        $perencanaans = Perencanaan::findOrFail($id);
        $perencanaans->delete();
        return redirect('/perencanaan/daftarperencanaan')->with('success_message', 'Perencanaan berhasil dihapus!');
    }
}
