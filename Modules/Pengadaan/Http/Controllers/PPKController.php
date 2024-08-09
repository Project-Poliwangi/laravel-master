<?php

namespace Modules\Pengadaan\Http\Controllers;

use App\Models\Core\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Modules\Pengadaan\Entities\Status;
use Modules\Kepegawaian\Entities\Pegawai;
use Modules\Pengadaan\Entities\Pengadaan;
use Modules\Pengadaan\Entities\Perencanaan;
use Illuminate\Contracts\Support\Renderable;
use Modules\Pengadaan\Entities\JenisPengadaan;
use Modules\Pengadaan\Entities\SubPerencanaan;
use Modules\Pengadaan\Entities\MetodePengadaan;

class PPKController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // Mengumpulkan data untuk distribusi status pengadaan
        $statusCounts = DB::table('pengadaan')
            ->join('pengadaan_status', 'pengadaan.status_id', '=', 'pengadaan_status.id')
            ->select('pengadaan_status.nama_status', DB::raw('count(*) as total'))
            ->groupBy('pengadaan_status.nama_status')
            ->get();

        // Mengumpulkan data untuk jumlah pengadaan per unit
        $unitCounts = DB::table('pengadaan')
            ->join('sub_perencanaans', 'pengadaan.subperencanaan_id', '=', 'sub_perencanaans.id')
            ->join('perencanaans', 'sub_perencanaans.perencanaan_id', '=', 'perencanaans.id')
            ->join('units', 'perencanaans.unit_id', '=', 'units.id')
            ->select('units.nama', DB::raw('count(*) as total'))
            ->groupBy('units.nama')
            ->get();

        // Mengumpulkan data untuk jenis pengadaan dari tabel sub_perencanaans
        $jenisPengadaanCounts = DB::table('sub_perencanaans')
            ->join('jenis_pengadaans', 'sub_perencanaans.jenis_pengadaan_id', '=', 'jenis_pengadaans.id')
            ->select('jenis_pengadaans.nama_jenis', DB::raw('count(*) as total'))
            ->groupBy('jenis_pengadaans.nama_jenis')
            ->get();

        return view('pengadaan::ppk.dashboard', compact('statusCounts', 'unitCounts', 'jenisPengadaanCounts'));
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

        // Get search query
        $search = $request->input('search');

        // Get SubPerencanaan records where ppk_id matches Pegawai's id
        $query = SubPerencanaan::where('ppk_id', $pegawai->id);

        // Apply search if there is a search query
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('kegiatan', 'LIKE', "%$search%")
                    ->orWhere('satuan', 'LIKE', "%$search%")
                    ->orWhereHas('metodepengadaans', function ($query) use ($search) {
                        $query->where('nama_metode', 'LIKE', "%$search%");
                    })
                    ->orWhereHas('jenisPengadaans', function ($query) use ($search) {
                        $query->where('nama_jenis', 'LIKE', "%$search%");
                    });
            });
        }

        // Get SubPerencanaan records with pagination
        $subPerencanaan = $query->paginate(10);

        $statuses = Status::all(); // Ambil semua status

        return view('pengadaan::ppk.pengadaan', compact('subPerencanaan', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        // $formMode = 'create';
        // return view('pengadaan::ppk.create', compact('formMode', 'perencanaan'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //     return redirect('/ppk/daftarpermohonan')->with('success', 'Permohonan Pengajuan Pengadaan berhasil ditambahkan.');
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

        return view('pengadaan::ppk.show', compact('subPerencanaan'));
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
        $metodepengadaans = MetodePengadaan::all(); // Ambil semua data metode dari model MetodePengadaan
        $pengadaanstatus = Status::all(); // Ambil semua data metode dari model Status
        $jenisPengadaans = JenisPengadaan::all();
        $pps = Pegawai::all(); // Ambil semua data PP dari model Pegawai
        $formMode = 'edit';

        return view('pengadaan::ppk.edit', compact('subPerencanaan', 'formMode', 'pps', 'pengadaan', 'metodepengadaans', 'pengadaanstatus', 'jenisPengadaans'));
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
            'metode_pengadaan_id' => 'required|exists:metode_pengadaans,id',
            'satuan' => 'required|string|max:255',
            'volume' => 'required|numeric',
            'harga_satuan' => 'required|numeric',
            'output' => 'required|string|max:255',
            'rencana_mulai' => 'required|date',
            'rencana_bayar' => 'required|date',
            'pp_id' => 'nullable|integer',
            'catatan' => 'nullable|string|max:65535', // Sesuaikan sesuai kebutuhan
            'dokumen_kak' => $pengadaan->dokumen_kak ? 'nullable|file|mimes:pdf|max:10240' : 'required|file|mimes:pdf|max:10240',
            'dokumen_hps' => $pengadaan->dokumen_hps ? 'nullable|file|mimes:pdf|max:10240' : 'required|file|mimes:pdf|max:10240',
            'dokumen_stock_opname' => 'nullable|file|mimes:pdf|max:10240',
            'dokumen_surat_ijin_impor' => 'nullable|file|mimes:pdf|max:10240',
        ];

        // Lakukan validasi
        $request->validate($rules);

        // Update data subPerencanaan
        $subPerencanaan->update($request->only([
            'metode_pengadaan_id', 'satuan', 'volume', 'harga_satuan', 'output', 'rencana_mulai', 'rencana_bayar', 'pp_id'
        ]));

        // Menambahkan catatan
        $pengadaan->catatan = $request->input('catatan');
        // Update status_id
        // $pengadaan->status_id = $request->input('status_id');

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

        $pengadaan->save();

        return redirect('/ppk/daftarpengadaan')->with('success_edit', 'Data Pengadaan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        // $ppengadaank = SubPerencanaan::findOrFail($id);
        // $ppengadaank->delete();
        // return redirect('/ppk/daftarpermohonan')->with('success_message', 'Pengadaan berhasil dihapus!');
    }

    public function updatestatus(Request $request, $id)
    {
        $request->validate([
            'status_id' => 'required|exists:pengadaan_status,id', // Pastikan ini sesuai dengan nama field di form
        ]);

        // Temukan pengadaan berdasarkan ID
        $pengadaan = Pengadaan::findOrFail($id);

        // Perbarui status pengadaan
        $pengadaan->status_id = $request->input('status_id');
        $pengadaan->save();

        return redirect()->back()->with('success', 'Status berhasil diubah');
    }
}
