<?php

namespace Modules\Pengadaan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Pengadaan\Entities\Unit;
use Modules\Pengadaan\Entities\Status;
use Modules\Kepegawaian\Entities\Pegawai;
use Modules\Pengadaan\Entities\Pengadaan;
use Illuminate\Contracts\Support\Renderable;
use Modules\Pengadaan\Entities\JenisPengadaan;
use Modules\Pengadaan\Entities\SubPerencanaan;
use Modules\Pengadaan\Entities\MetodePengadaan;

class PPController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('pengadaan::index');
    }

    public function daftarpengadaan(Request $request)
    {
        // Get the logged-in user
        $user = Auth::user();
        $pegawaisId = $user->pegawais_id;

        // Get the Pegawai associated with the logged-in user
        $pegawai = Pegawai::find($pegawaisId);

        // Check if Pegawai exists
        if (!$pegawai) {
            return redirect()->back()->withErrors(['message' => 'Data pegawai tidak ditemukan.']);
        }

        // Get SubPerencanaan records where ppk_id matches Pegawai's id
        $subPerencanaan = SubPerencanaan::where('pp_id', $pegawai->id)->paginate(15);

        return view('pengadaan::pp.daftarpengadaan', compact('subPerencanaan'));
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

        return view('pengadaan::pp.show', compact('subPerencanaan'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $subPerencanaan = SubPerencanaan::findOrFail($id);
        $pengadaan = Pengadaan::where('subperencanaan_id', $id)->first(); // Ambil data pengadaan terkait
        $metodepengadaans = MetodePengadaan::all();
        $jenisPengadaans = JenisPengadaan::all();
        $pengadaanstatus = Status::all();
        $unit = Unit::all();
        $formMode = 'edit';

        return view('pengadaan::pp.edit', compact('subPerencanaan', 'formMode', 'pengadaan', 'metodepengadaans', 'jenisPengadaans', 'pengadaanstatus', 'unit'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $subPerencanaan = SubPerencanaan::find($id);

        if (!$subPerencanaan) {
            return redirect()->back()->withErrors(['message' => 'SubPerencanaan tidak ditemukan']);
        }

        // Ambil pengadaan terkait subperencanaan
        $pengadaan = $subPerencanaan->pengadaan; // Pastikan Anda memiliki relasi pengadaan di model SubPerencanaan

        if (!$pengadaan) {
            // Jika tidak ada pengadaan terkait, buat yang baru
            $pengadaan = new Pengadaan();
            $pengadaan->subperencanaan_id = $subPerencanaan->id;
        }

        // Periksa apakah status pengadaan adalah "Pemilihan Penyedia"
        if ($pengadaan->status->nama_status != 'Pemilihan Penyedia') {
            return redirect()->back()->withErrors(['message' => 'Anda hanya bisa mengunggah dokumen pemilihan penyedia jika status pengadaan adalah Pemilihan Penyedia']);
        }

        // Aturan validasi
        $rules = [
            'dokumen_pemilihan_penyedia' => 'nullable|file|mimes:pdf|max:10240'
        ];

        // Lakukan validasi
        $request->validate($rules);

        // Update dokumen jika file baru diunggah
        if ($request->hasFile('dokumen_kak')) {
            $pengadaan->dokumen_kak = $request->file('dokumen_kak')->store('dokumen_kak', 'public');
        }
        if ($request->hasFile('dokumen_hps')) {
            $pengadaan->dokumen_hps = $request->file('dokumen_hps')->store('dokumen_hps', 'public');
        }
        if ($request->hasFile('dokumen_stock_opname')) {
            $pengadaan->dokumen_stock_opname = $request->file('dokumen_stock_opname')->store('dokumen_stock_opname', 'public');
        }
        if ($request->hasFile('dokumen_surat_ijin_impor')) {
            $pengadaan->dokumen_surat_ijin_impor = $request->file('dokumen_surat_ijin_impor')->store('dokumen_surat_ijin_impor', 'public');
        }
        if ($request->hasFile('dokumen_pemilihan_penyedia')) {
            $pengadaan->dokumen_pemilihan_penyedia = $request->file('dokumen_pemilihan_penyedia')->store('dokumen_pemilihan_penyedia', 'public');
        }

        $pengadaan->save();

        return redirect('/pp/daftarpengadaan')->with('success_edit', 'Data Pengadaan berhasil diperbarui!');
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
