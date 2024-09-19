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
        // Ambil user yang sedang login
        $user = Auth::user();
        $pegawaisId = $user->pegawais_id;
    
        // Ambil data Pegawai yang terkait dengan user yang login
        $pegawai = Pegawai::find($pegawaisId);
    
        // Periksa jika data Pegawai ada
        if (!$pegawai) {
            return redirect()->back()->withErrors(['message' => 'Data pegawai tidak ditemukan.']);
        }
    
        // Ambil SubPerencanaan yang sesuai dengan pp_id Pegawai dan sudah diverifikasi oleh PPK
        $subPerencanaan = SubPerencanaan::where('pp_id', $pegawai->id)
            ->whereHas('pengadaan', function ($query) {
                // Filter pengadaan yang sudah diverifikasi oleh PPK dan memiliki catatan
                $query->whereNotNull('catatan')
                      ->where('status_id', function ($subQuery) {
                          $subQuery->select('id')
                                   ->from('pengadaan_status')
                                   ->where('nama_status', 'Pemenuhan Dokumen');
                      });
            })
            ->get();
    
        $status = Status::all();
    
        return view('pengadaan::pp.daftarpengadaan', compact('subPerencanaan', 'status'));
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
        $metodePengadaan = MetodePengadaan::all();
        $jenisPengadaan = JenisPengadaan::all();
        $status = Status::all();
        $unit = Unit::all();
        $formMode = 'edit';

        return view('pengadaan::pp.edit', compact('subPerencanaan', 'formMode', 'pengadaan', 'metodePengadaan', 'jenisPengadaan', 'status', 'unit'));
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
        $pengadaan = $subPerencanaan->pengadaan; // memastikan relasi pengadaan di SubPerencanaan

        if (!$pengadaan) {
            // Jika tidak ada pengadaan terkait, buat yang baru
            $pengadaan = new Pengadaan();
            $pengadaan->subperencanaan_id = $subPerencanaan->id;
        }

        // Periksa apakah status pengadaan adalah "Pemenuhan Dokumen"
        if ($pengadaan->status->nama_status != 'Pemenuhan Dokumen') {
            return redirect()->back()->withErrors(['message' => 'Anda hanya bisa mengunggah dokumen pemilihan penyedia jika status pengadaan adalah Pemenuhan Dokumen']);
        }

        // Aturan validasi
        $rules = [
            'dokumen_pemilihan_penyedia' => 'nullable|file|mimes:pdf|max:10240'
        ];

        // Lakukan validasi
        $request->validate($rules);

        // Update dokumen jika file baru diunggah
        if ($request->hasFile('dokumen_pemilihan_penyedia')) {
            $pengadaan->dokumen_pemilihan_penyedia = $request->file('dokumen_pemilihan_penyedia')->store('dokumen_pemilihan_penyedia', 'public');
        }

        $pengadaan->save();

        // Panggil fungsi checkAndUpdateStatus
        $pengadaan->checkAndUpdateStatus();

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
