<?php

namespace Modules\Pengadaan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Pengadaan\Entities\Unit;
use Modules\Kepegawaian\Entities\Pegawai;
use Modules\Pengadaan\Entities\Perencanaan;
use Illuminate\Contracts\Support\Renderable;
use Modules\Pengadaan\Entities\JenisPengadaan;
use Modules\Pengadaan\Entities\SubPerencanaan;
use Modules\Pengadaan\Entities\MetodePengadaan;

class SubPerencanaanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $perencanaan = Perencanaan::all();
        $keyword = $request->get('search'); 
        $perPage = 10;

        if (!empty($keyword)) {
            $subperencanaan = SubPerencanaan::where('nomor_surat', 'LIKE', "%$keyword%")
                ->orWhere('jenis_pengadaan', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $subperencanaan = SubPerencanaan::latest()->paginate($perPage);
        }

        return view('pengadaan::subperencanaan.subperencanaan', compact('subperencanaan', 'perencanaan'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $formMode = 'create';
        $jenispengadaans = JenisPengadaan::all();
        $perencanaans = Perencanaan::all();
        $units = Unit::all();
        $ppk = Pegawai::all();

        return view('pengadaan::subperencanaan.create', compact('formMode', 'jenispengadaans', 'perencanaans', 'units', 'ppk'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'kegiatan' => 'required|string|max:150',
            'satuan' => 'required|string|max:50',
            'volume' => 'required|integer|min:1',
            'harga_satuan' => 'required|integer|min:1',
            'output' => 'required|string|max:255',
            'rencana_mulai' => 'required|date',
            'rencana_bayar' => 'required|date',
            'perencanaan_id' => 'required|exists:perencanaans,id',
            'unit_id' => 'required|exists:units,id',
            'ppk_id' => 'required|exists:pegawais,id',
            'jenis_pengadaan_id' => 'required|exists:jenis_pengadaans,id',
        ]);

        // Simpan data ke dalam database
        SubPerencanaan::create($validatedData);

        return redirect('/subperencanaan/subperencanaan')->with('success', 'Program/Kegiatan Pengadaan berhasil ditambahkan.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $subperencanaan= SubPerencanaan::findOrFail($id);
        return view('pengadaan::subperencanaan.show', compact('subperencanaan'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $jenispengadaans = JenisPengadaan::all();
        $subperencanaan = SubPerencanaan::findOrFail($id);
        $perencanaans = Perencanaan::all(); // Mengambil semua data perencanaan
        $ppk = Pegawai::all();
        $units = Unit::all();
        $formMode = 'edit';

        return view('pengadaan::subperencanaan.edit', compact('subperencanaan', 'formMode', 'jenispengadaans', 'perencanaans', 'ppk', 'units'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $subperencanaan = SubPerencanaan::findOrFail($id);

        // Validasi data yang masuk
        $validatedData = $request->validate([
            'kegiatan' => 'required|string|max:150',
            'satuan' => 'required|string|max:50',
            'volume' => 'required|integer|min:1',
            'harga_satuan' => 'required|integer|min:1',
            'output' => 'required|string|max:255',
            'rencana_mulai' => 'required|date',
            'rencana_bayar' => 'required|date',
            'perencanaan_id' => 'required|exists:perencanaans,id',
            'unit_id' => 'required|exists:units,id',
            'ppk_id' => 'required|exists:pegawais,id',
            'jenis_pengadaan_id' => 'required|exists:jenis_pengadaans,id',
        ]);

        $subperencanaan->update($validatedData);

        return redirect('/subperencanaan/subperencanaan')->with('success', 'Program/Kegiatan Pengadaan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $subperencanaan = SubPerencanaan::findOrFail($id);
        $subperencanaan->delete();
        return redirect('/subperencanaan/subperencanaan')->with('success', 'Program/Kegiatan Pengadaan berhasil dihapus!');
    }

    public function showPermohonan($id)
    {
        $subperencanaan = Perencanaan::find($id); // Mengambil data perencanaan berdasarkan ID
    
        return view('pengadaan::subperencanaan.subperencanaan', compact('subperencanaan'));
    }

    // public function showMetodePengadaan($id)
    // {
    //     $subperencanaan = MetodePengadaan::find($id); // Mengambil data metodepengadaan berdasarkan ID
    
    //     return view('pengadaan::subperencanaan.subperencanaan', compact('subperencanaan'));
    // }
}
