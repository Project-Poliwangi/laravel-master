<?php

namespace Modules\Pengadaan\Http\Controllers;

use Carbon\Carbon;
use App\Models\Core\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Modules\Pengadaan\Entities\Status;
use Illuminate\Support\Facades\Storage;
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
        // Mengimpor Carbon untuk mendapatkan tahun saat ini
        $currentYear = Carbon::now()->year;

        // Menghitung total pengadaan
        $totalPengadaan = Pengadaan::count();

        // Menghitung pengadaan baru dalam tahun ini
        $pengadaanBaru = Pengadaan::whereYear('created_at', $currentYear)->count();

        // Menghitung pengadaan yang selesai dalam tahun ini
        $pengadaanSelesai = Pengadaan::where('status_id', 4) // Status 4 untuk "Selesai"
            ->whereYear('updated_at', $currentYear)
            ->count();

        // Mengambil semua jenis pengadaan, status pengadaan, dan metode pengadaan
        $jenisPengadaans = JenisPengadaan::all();
        $pengadaanStatuses = Status::all();
        $metodePengadaans = MetodePengadaan::all();

        // Menghitung jumlah pengadaan berdasarkan jenis
        $jenisPengadaanData = SubPerencanaan::select('jenis_pengadaan_id')
            ->selectRaw('count(*) as count')
            ->groupBy('jenis_pengadaan_id')
            ->get()
            ->pluck('count', 'jenis_pengadaan_id');

        // Menghitung jumlah pengadaan berdasarkan status
        $pengadaanStatusData = Pengadaan::select('status_id')
            ->selectRaw('count(*) as count')
            ->groupBy('status_id')
            ->get()
            ->pluck('count', 'status_id');

        // Menghitung jumlah pengadaan berdasarkan metode
        $metodePengadaanData = SubPerencanaan::select('metode_pengadaan_id')
            ->selectRaw('count(*) as count')
            ->groupBy('metode_pengadaan_id')
            ->get()
            ->pluck('count', 'metode_pengadaan_id');

        // Memastikan setiap jenis pengadaan ada dalam data, meskipun nilainya nol
        $jenisPengadaanChart = $jenisPengadaans->map(function ($jenis) use ($jenisPengadaanData) {
            return [
                'label' => $jenis->nama_jenis,
                'count' => $jenisPengadaanData->get($jenis->id, 0),
            ];
        });

        // Memastikan setiap status pengadaan ada dalam data, meskipun nilainya nol
        $pengadaanStatusChart = $pengadaanStatuses->map(function ($status) use ($pengadaanStatusData) {
            return [
                'label' => $status->nama_status,
                'count' => $pengadaanStatusData->get($status->id, 0),
            ];
        });

        // Memastikan setiap metode pengadaan ada dalam data, meskipun nilainya nol
        $metodePengadaanChart = $metodePengadaans->map(function ($metode) use ($metodePengadaanData) {
            return [
                'label' => $metode->nama_metode,
                'count' => $metodePengadaanData->get($metode->id, 0),
            ];
        });

        // Mengirimkan data ke view
        return view('pengadaan::direktur.dashboard', compact(
            'jenisPengadaanChart',
            'pengadaanStatusChart',
            'metodePengadaanChart',
            'totalPengadaan',
            'pengadaanBaru',
            'pengadaanSelesai'
        ));
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

        // Ambil Pengadaan berdasarkan ID SubPerencanaan
        $pengadaan = Pengadaan::where('subperencanaan_id', $id)->first();

        // Status default jika tidak ada dalam database
        $status = 0; // Misalnya status 0 untuk 'Belum Dalam Periode'

        // Cek status yang ada di database
        if ($pengadaan && $pengadaan->status_id && in_array($pengadaan->status_id, [1, 2, 3, 4])) {
            $status = $pengadaan->status_id;
        }

        return view('pengadaan::ppk.show', compact('subPerencanaan', 'status'));
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
            'dokumen_serah_terima' => 'nullable|file|mimes:pdf|max:10240',
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

        // Handle dokumen_kontrak
        if ($request->hasFile('dokumen_kontrak')) {
            if ($request->input('existing_dokumen_kontrak')) {
                Storage::disk('public')->delete($request->input('existing_dokumen_kontrak'));
            }
            $pengadaan->dokumen_kontrak = $request->file('dokumen_kontrak')->store('dokumen_kontrak', 'public');
        } elseif ($request->input('existing_dokumen_kontrak')) {
            $pengadaan->dokumen_kontrak = $request->input('existing_dokumen_kontrak');
        }

        // Handle dokumen_serah_terima
        if ($request->hasFile('dokumen_serah_terima')) {
            if ($request->input('existing_dokumen_serah_terima')) {
                Storage::disk('public')->delete($request->input('existing_dokumen_serah_terima'));
            }
            $pengadaan->dokumen_serah_terima = $request->file('dokumen_serah_terima')->store('dokumen_serah_terima', 'public');
        } elseif ($request->input('existing_dokumen_serah_terima')) {
            $pengadaan->dokumen_serah_terima = $request->input('existing_dokumen_serah_terima');
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
