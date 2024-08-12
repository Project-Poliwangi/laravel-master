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

        // Get SubPerencanaan records where ppk_id matches Pegawai's id
        $subPerencanaan = SubPerencanaan::where('ppk_id', $pegawai->id)->paginate(10);

        foreach ($subPerencanaan as $unit) {
            if ($unit->pengadaan) {
                $unit->pengadaan->checkAndUpdateStatus();
            }
        }

        $status = Status::all(); // Ambil semua status
        $metodePengadaan = MetodePengadaan::all(); // Ambil semua status

        return view('pengadaan::ppk.pengadaan', compact('subPerencanaan', 'status', 'metodePengadaan'));
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
        $subPerencanaan = SubPerencanaan::with(['perencanaan', 'pengadaan'])->find($id);
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
        $metodePengadaan = MetodePengadaan::all(); // Ambil semua data metode dari model MetodePengadaan
        $status = Status::all(); // Ambil semua data metode dari model Status
        $jenisPengadaan = JenisPengadaan::all();
        $pp = Pegawai::all(); // Ambil semua data PP dari model Pegawai
        $formMode = 'edit';

        return view('pengadaan::ppk.edit', compact('subPerencanaan', 'formMode', 'pp', 'pengadaan', 'metodePengadaan', 'status', 'jenisPengadaan'));
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
            'metode_pengadaan_id' => 'required|exists:metode_pengadaans,id',
            'satuan' => 'required|string|max:255',
            'volume' => 'required|numeric',
            'harga_satuan' => 'required|numeric',
            'pagu' => 'required|numeric',
            'output' => 'required|string|max:255',
            'rencana_mulai' => 'required|date',
            'rencana_bayar' => 'required|date',
            'pp_id' => 'nullable|integer',
            'catatan' => 'nullable|string|max:65535', // Sesuaikan sesuai kebutuhan
            'dokumen_kontrak' => 'nullable|file|mimes:pdf|max:10240',
            'dokumen_serah terima' => 'nullable|file|mimes:pdf|max:10240',
        ];

        // Lakukan validasi
        $request->validate($rules);

        // Update data subPerencanaan
        $subPerencanaan->update($request->only([
            'metode_pengadaan_id',
            'satuan',
            'volume',
            'harga_satuan',
            'pagu',
            'output',
            'rencana_mulai',
            'rencana_bayar',
            'pp_id'
        ]));

        // Menambahkan catatan
        $pengadaan->catatan = $request->input('catatan');

        if ($request->hasFile('dokumen_kontrak')) {
            $pengadaan->dokumen_kontrak = $request->file('dokumen_kontrak')->store('dokumen_kontrak', 'public');
        }
        if ($request->hasFile('dokumen_serah_terima')) {
            $pengadaan->dokumen_serah_terima = $request->file('dokumen_serah_terima')->store('dokumen_serah_terima', 'public');
        }

        $pengadaan->save();

        // Panggil fungsi checkAndUpdateStatus
        $pengadaan->checkAndUpdateStatus();

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
    }
}
