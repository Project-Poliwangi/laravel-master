<?php

namespace Modules\Pengadaan\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
        $subPerencanaan = SubPerencanaan::all();
        return view('pengadaan::unit.dashboard', compact('subPerencanaan'));
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $subPerencanaan = SubPerencanaan::all();
        $perencanaan = Perencanaan::all();
        $formMode = 'create';
        return view('pengadaan::unit.create', compact('formMode', 'subPerencanaan', 'perencanaan'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'satuan' => 'required|string|max:255',
        //     'volume' => 'required|numeric',
        //     'harga_satuan' => 'required|numeric',
        //     'output' => 'required|string|max:255',
        //     'rencana_mulai' => 'required|date',
        //     'rencana_bayar' => 'required|date',
        //     'pic_id' => 'required|integer',
        //     'dokumen_kak' => 'required|file|mimes:pdf|max:10240',
        //     'dokumen_hps' => 'required|file|mimes:pdf|max:10240',
        //     'dokumen_stock_opname' => 'nullable|file|mimes:pdf|max:10240',
        //     'dokumen_surat_ijin_impor' => 'nullable|file|mimes:pdf|max:10240',
        // ]);

        // $subPerencanaan = SubPerencanaan::create($request->only([
        //     'satuan', 'volume', 'harga_satuan', 'output',
        //     'rencana_mulai', 'rencana_bayar', 'pic_id'
        // ]));

        // // $subperencanaan->save();

        // $pengadaan = new Pengadaan();
        // $pengadaan->subperencanaan_id = $subPerencanaan->id;

        // // Mengelola upload dokumen jika ada
        // if ($request->hasFile('dokumen_kak')) {
        //     $file = $request->file('dokumen_kak');
        //     $filePath = $file->store('dokumen_kak', 'public');
        //     $pengadaan->dokumen_kak = $filePath;
        // }
        // if ($request->hasFile('dokumen_hps')) {
        //     $file = $request->file('dokumen_hps');
        //     $filePath = $file->store('dokumen_hps', 'public');
        //     $pengadaan->dokumen_hps = $filePath;
        // }
        // if ($request->hasFile('dokumen_stock_opname')) {
        //     $file = $request->file('dokumen_stock_opname');
        //     $filePath = $file->store('dokumen_stock_opname', 'public');
        //     $pengadaan->dokumen_stock_opname = $filePath;
        // }
        // if ($request->hasFile('dokumen_surat_ijin_impor')) {
        //     $file = $request->file('dokumen_surat_ijin_impor');
        //     $filePath = $file->store('dokumen_surat_ijin_impor', 'public');
        //     $pengadaan->dokumen_surat_ijin_impor = $filePath;
        // }

        // // Simpan data pengadaan
        // $pengadaan->save();

        // return redirect('/unit/daftarpermohonan')->with('success', 'Data berhasil disimpan.');
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

        // Aturan validasi
        $rules = [
            'satuan' => 'required|string|max:255',
            'volume' => 'required|numeric',
            'harga_satuan' => 'required|numeric',
            'output' => 'required|string|max:255',
            'rencana_mulai' => 'required|date',
            'rencana_bayar' => 'required|date',
            'pic_id' => 'nullable|integer',
            'dokumen_kak' => $pengadaan->dokumen_kak ? 'nullable|file|mimes:pdf|max:10240' : 'required|file|mimes:pdf|max:10240',
            'dokumen_hps' => $pengadaan->dokumen_hps ? 'nullable|file|mimes:pdf|max:10240' : 'required|file|mimes:pdf|max:10240',
            'dokumen_stock_opname' => 'nullable|file|mimes:pdf|max:10240',
            'dokumen_surat_ijin_impor' => 'nullable|file|mimes:pdf|max:10240',
        ];

        // Lakukan validasi
        $request->validate($rules);

        // Update data subPerencanaan
        $subPerencanaan->update($request->only([
            'satuan', 'volume', 'harga_satuan', 'output', 'rencana_mulai', 'rencana_bayar', 'pic_id'
        ]));

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

        $pengadaan->save();

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
        // $pengadaan = Pengadaan::findOrFail($id);
        // $pengadaan->delete();

        // $subPerencanaan = SubPerencanaan::findOrFail($id);
        // $pengadaan = $subPerencanaan->pengadaan;

        // if ($pengadaan) {
        //     $pengadaan->delete();
        // }

        // $subPerencanaan->delete();

        return redirect('/unit/daftarpermohonan')->with('success_message', 'Permohonan berhasil dihapus!');
    }

    // public function daftarpermohonan(Request $request)
    // {
    //     $coba = DB::table('users')
    //         ->join('units', 'users.unit', '=', 'units.id')
    //         ->where('users.id', auth()->id())
    //         ->select('units.id')
    //         ->first();
    //     $cobak = DB::table('perencanaans')
    //         ->join('sub_perencanaans', 'perencanaans.id', '=', 'sub_perencanaans.perencanaan_id')
    //         ->where('perencanaans.unit_id', $coba->id)
    //         ->select('sub_perencanaans.*','perencanaans.*')
    //         ->get();
    //         // dd($cobak);s
    //     $keyword = $request->get('search');

    //     $perPage = 15;

    //     if (!empty($keyword)) {
    //         $pengadaan = Pengadaan::where('nomor_surat', 'like', '%' . $keyword . '%')
    //             ->orWhere('jenis_pengadaan', 'like', '%' . $keyword . '%')
    //             ->orWhere('total_biaya', 'like', '%' . $keyword . '%')
    //             ->orderBy('created_at', 'desc')
    //             ->latest()->paginate($perPage);
    //     } else {
    //         $pengadaan = Pengadaan::latest()->paginate($perPage);
    //     }

    //     return view('pengadaan::unit.permohonan', compact('pengadaan','cobak'));
    // }

    public function daftarpengadaan(Request $request)
    {
        // Ambil user yang sedang login
        $user = Auth::user();
        $unitId = $user->unit; // Ambil unit_id dari user

        // \Log::info('User ID: ' . $user->id);
        // \Log::info('Unit ID: ' . $unitId);

        // Ambil parameter jumlah item per halaman dari request, default ke 10
        $perPage = $request->input('per_page', 10);

        // Query untuk mengambil data dari tabel sub_perencanaans berdasarkan unit_id
        $subPerencanaan = SubPerencanaan::where('unit_id', $unitId)->paginate($perPage);

        // \Log::info('Sub Perencanaans: ' . $subPerencanaans->toJson());

        // Kirim data ke view
        return view('pengadaan::unit.pengadaan', compact('subPerencanaan'));
    }

    public function listTemplateDokumen()
    {
        $templateDokumens = Document::all();
        return view('pengadaan::unit.template', compact('templateDokumens'));
    }
}
