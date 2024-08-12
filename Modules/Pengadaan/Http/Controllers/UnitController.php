<?php

namespace Modules\Pengadaan\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Modules\Pengadaan\Entities\Unit;
use Modules\Pengadaan\Entities\Status;
use Illuminate\Support\Facades\Storage;
use Modules\Pengadaan\Entities\Document;
use Modules\Kepegawaian\Entities\Pegawai;
use Modules\Pengadaan\Entities\Pengadaan;
use Modules\Pengadaan\Entities\Perencanaan;
use Illuminate\Contracts\Support\Renderable;
use Modules\Pengadaan\Entities\SubPerencanaan;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        return view('pengadaan::unit.dashboard');
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        // 
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

        $subPerencanaan = SubPerencanaan::with(['perencanaan', 'pengadaan', 'status'])->find($id);
        if (!$subPerencanaan) {
            return response()->json(['message' => 'SubPerencanaan tidak ditemukan'], 404);
        }

        return view('pengadaan::unit.show', compact('subPerencanaan'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $subPerencanaan = SubPerencanaan::find($id);
        if (!$subPerencanaan) {
            return redirect()->back()->withErrors(['message' => 'SubPerencanaan tidak ditemukan']);
        }
        $pengadaan = Pengadaan::where('subperencanaan_id', $id)->first(); // Ambil data pengadaan terkait
        $pics = Pegawai::all(); // Ambil semua data PIC dari model Pegawai

        // Mengirim data catatan ke view jika status pengadaan adalah "pemilihan penyedia"
        $catatan = ($pengadaan->status->nama_status == 'Pemenuhan Dokumen') ? $pengadaan->catatan : '-';


        $formMode = 'edit';

        return view('pengadaan::unit.edit', compact('pengadaan', 'formMode', 'subPerencanaan', 'pics', 'catatan'));
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

        // Menghapus pemisah ribuan pada harga_satuan sebelum validasi
        $request->merge([
            'harga_satuan' => str_replace('.', '', $request->input('harga_satuan')),
            'pagu' => str_replace('.', '', $request->input('pagu')),
        ]);

        // Aturan validasi
        $rules = [
            'satuan' => 'required|string|max:255',
            'volume' => 'required|integer|min:0',
            'harga_satuan' => 'required|integer|min:0',
            'pagu' => 'required|integer|min:0',
            'output' => 'required|string|max:255',
            'rencana_mulai' => 'required|date',
            'rencana_bayar' => 'required|date',
            'pic_id' => 'nullable|integer',
            'dokumen_kak' => $pengadaan->dokumen_kak ? 'nullable|file|mimes:pdf|max:10240' : 'required|file|mimes:pdf|max:10240',
            'dokumen_hps' => 'nullable|file|mimes:pdf|max:10240',
            'dokumen_stock_opname' => 'nullable|file|mimes:pdf|max:10240',
            'dokumen_surat_ijin_impor' => 'nullable|file|mimes:pdf|max:10240',
        ];

        // Lakukan validasi
        $request->validate($rules);

        // Update data subPerencanaan
        $subPerencanaan->update($request->only([
            'satuan',
            'volume',
            'harga_satuan',
            'pagu',
            'output',
            'rencana_mulai',
            'rencana_bayar',
            'pic_id'
        ]));

        // Menangani upload file dokumen
        $dokumenFields = [
            'dokumen_kak' => 'dokumen_kak',
            'dokumen_hps' => 'dokumen_hps',
            'dokumen_stock_opname' => 'dokumen_stock_opname',
            'dokumen_surat_ijin_impor' => 'dokumen_surat_ijin_impor',
        ];

        foreach ($dokumenFields as $field => $folder) {
            if ($request->hasFile($field)) {
                // Hapus dokumen lama jika ada
                if ($pengadaan->{$field}) {
                    Storage::disk('public')->delete($pengadaan->{$field});
                }
                $pengadaan->{$field} = $request->file($field)->store($folder, 'public');
            }
        }

        $pengadaan->save();

        // Panggil fungsi checkAndUpdateStatus
        $pengadaan->checkAndUpdateStatus();

        return redirect('/unit/daftarpengadaan')->with('success_edit', 'Data pengadaan berhasil diperbarui!');
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

    public function daftarpengadaan(Request $request)
    {
        // Ambil user yang sedang login
        $user = Auth::user();
        $unitId = $user->unit; // Ambil unit_id dari user

        // Query untuk mengambil data dari tabel sub_perencanaans berdasarkan unit_id
        $subPerencanaan = SubPerencanaan::where('unit_id', $unitId)
            ->with(['pengadaan.status']) // Pastikan eager loading relasi
            ->get();

        $status = Status::all();

        // Update status pengadaan untuk setiap subPerencanaan
        foreach ($subPerencanaan as $unit) {
            if ($unit->pengadaan) {
                $unit->pengadaan->checkAndUpdateStatus();
            }
        }

        // Kirim data ke view
        return view('pengadaan::unit.pengadaan', compact('subPerencanaan', 'status'));
    }

    public function listTemplateDokumen()
    {
        $templateDokumens = Document::all();
        return view('pengadaan::unit.template', compact('templateDokumens'));
    }
}
