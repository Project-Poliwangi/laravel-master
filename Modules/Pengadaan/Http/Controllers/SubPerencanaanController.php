<?php

namespace Modules\Pengadaan\Http\Controllers;

use App\Models\Core\User;
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
        $subPerencanaan = SubPerencanaan::all();

        return view('pengadaan::subperencanaan.subperencanaan', compact('subPerencanaan'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $formMode = 'create';
        $jenisPengadaan = JenisPengadaan::all();
        $perencanaan = Perencanaan::all();
        $unit = Unit::all();
        $ppk = Pegawai::all();

        return view('pengadaan::subperencanaan.create', compact('formMode', 'jenisPengadaan', 'perencanaan', 'unit', 'ppk'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        // Menghapus pemisah ribuan pada harga_satuan sebelum validasi
        $request->merge([
            'harga_satuan' => str_replace('.', '', $request->input('harga_satuan')),
            'pagu' => str_replace('.', '', $request->input('pagu')),
        ]);

        // Validasi data yang masuk
        $validatedData = $request->validate([
            'kegiatan' => 'required|string|max:150',
            'satuan' => 'required|string|max:50',
            'volume' => 'required|integer|min:1',
            'harga_satuan' => 'required|integer|min:1',
            'pagu' => 'required|integer|min:1',
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

        return redirect('/subperencanaan/subperencanaan')->with('success', 'Sub Perencanaan berhasil ditambahkan.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $subPerencanaan = SubPerencanaan::with('perencanaan', 'unit', 'jenisPengadaan', 'ppk')->find($id);
        return view('pengadaan::subperencanaan.show', compact('subPerencanaan'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $subPerencanaan = SubPerencanaan::findOrFail($id);
        $jenisPengadaan = JenisPengadaan::all();
        $perencanaan = Perencanaan::all(); // Mengambil semua data perencanaan
        $ppk = Pegawai::all();
        $unit = Unit::all();
        $formMode = 'edit';

        return view('pengadaan::subperencanaan.edit', compact('subPerencanaan', 'formMode', 'jenisPengadaan', 'perencanaan', 'ppk', 'unit'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $subPerencanaan = SubPerencanaan::findOrFail($id);

        // Menghapus pemisah ribuan pada harga_satuan sebelum validasi
        $request->merge([
            'harga_satuan' => str_replace('.', '', $request->input('harga_satuan')),
            'pagu' => str_replace('.', '', $request->input('pagu')),
        ]);

        // Validasi data yang masuk
        $validatedData = $request->validate([
            'kegiatan' => 'required|string|max:150',
            'satuan' => 'required|string|max:50',
            'volume' => 'required|integer|min:1',
            'harga_satuan' => 'required|integer|min:1',
            'pagu' => 'required|integer|min:1',
            'output' => 'required|string|max:255',
            'rencana_mulai' => 'required|date',
            'rencana_bayar' => 'required|date',
            'perencanaan_id' => 'required|exists:perencanaans,id',
            'unit_id' => 'required|exists:units,id',
            'ppk_id' => 'required|exists:pegawais,id',
            'jenis_pengadaan_id' => 'required|exists:jenis_pengadaans,id',
        ]);

        $subPerencanaan->update($validatedData);

        return redirect('/subperencanaan/subperencanaan')->with('success', 'Sub Perencanaan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $subPerencanaan = SubPerencanaan::findOrFail($id);
        $subPerencanaan->delete();
        return redirect('/subperencanaan/subperencanaan')->with('success', 'Sub Perencanaan berhasil dihapus!');
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
