<?php

namespace Modules\Pengadaan\Http\Controllers;

use Carbon\Carbon;
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
use Modules\Pengadaan\Entities\JenisPengadaan;
use Modules\Pengadaan\Entities\SubPerencanaan;
use Modules\Pengadaan\Entities\MetodePengadaan;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index(Request $request)
    {
        // Ambil user yang sedang login
        $user = Auth::user();
        $unitId = $user->unit; // Ambil unit_id dari user

        // Ambil tahun anggaran dari request
        $tahunAnggaran = $request->input('tahun_anggaran');

        // Mendapatkan ID subperencanaan yang terkait dengan unit pengguna
        $subPerencanaanIds = SubPerencanaan::where('unit_id', $unitId)->pluck('id');

        // Query dasar untuk menghitung pengadaan
        $basePengadaanQuery = Pengadaan::whereIn('subperencanaan_id', $subPerencanaanIds);

        if ($tahunAnggaran) {
            // Jika tahun anggaran dipilih, tambahkan filter tahun
            $basePengadaanQuery->whereYear('created_at', $tahunAnggaran);
        }

        // Menghitung total pengadaan berdasarkan unit
        $totalPengadaan = (clone $basePengadaanQuery)->count();

        // Mendapatkan ID status dengan pengecekan
        $statusPemenuhanDokumen = Status::where('nama_status', 'Pemenuhan Dokumen')->first();
        $statusPemilihanPenyedia = Status::where('nama_status', 'Pemilihan Penyedia')->first();
        $statusKontrak = Status::where('nama_status', 'Kontrak')->first();
        $statusSerahTerima = Status::where('nama_status', 'Serah Terima')->first();

        // Menghitung pengadaan berjalan
        $pengadaanBerjalan = (clone $basePengadaanQuery)
            ->whereIn('status_id', [
                $statusPemenuhanDokumen->id,
                $statusPemilihanPenyedia->id,
                $statusKontrak->id
            ])
            ->count();

        // Menghitung pengadaan selesai
        $pengadaanSelesai = (clone $basePengadaanQuery)
            ->where('status_id', $statusSerahTerima->id)
            ->count();

        // Mengambil semua jenis pengadaan, status pengadaan, dan metode pengadaan
        $jenisPengadaan = JenisPengadaan::all();
        $metodePengadaan = MetodePengadaan::all();
        $pengadaanStatus = Status::all();

        // Query dasar untuk perhitungan berdasarkan jenis pengadaan
        $jenisPengadaanQuery = SubPerencanaan::select('jenis_pengadaan_id')
            ->where('unit_id', $unitId);

        if ($tahunAnggaran) {
            $jenisPengadaanQuery->whereYear('created_at', $tahunAnggaran);
        }

        $jenisPengadaanCounts = $jenisPengadaanQuery
            ->selectRaw('count(*) as count')
            ->groupBy('jenis_pengadaan_id')
            ->get()
            ->pluck('count', 'jenis_pengadaan_id');

        $jenisPengadaanChart = $jenisPengadaan->map(function ($jenis) use ($jenisPengadaanCounts) {
            return [
                'label' => $jenis->nama_jenis,
                'count' => $jenisPengadaanCounts->get($jenis->id, 0),
            ];
        });

        // Query dasar untuk perhitungan berdasarkan metode pengadaan
        $metodePengadaanQuery = SubPerencanaan::select('metode_pengadaan_id')
            ->where('unit_id', $unitId);

        if ($tahunAnggaran) {
            $metodePengadaanQuery->whereYear('created_at', $tahunAnggaran);
        }

        $metodePengadaanCounts = $metodePengadaanQuery
            ->selectRaw('count(*) as count')
            ->groupBy('metode_pengadaan_id')
            ->get()
            ->pluck('count', 'metode_pengadaan_id');

        $metodePengadaanChart = $metodePengadaan->map(function ($metode) use ($metodePengadaanCounts) {
            return [
                'label' => $metode->nama_metode,
                'count' => $metodePengadaanCounts->get($metode->id, 0),
            ];
        });

        // Query dasar untuk perhitungan berdasarkan status pengadaan dengan join ke tabel subPerencanaan
        $statusPengadaanQuery = Pengadaan::select('pengadaan.status_id')
            ->join('sub_perencanaans', 'pengadaan.subperencanaan_id', '=', 'sub_perencanaans.id')
            ->where('sub_perencanaans.unit_id', $unitId);

        if ($tahunAnggaran) {
            $statusPengadaanQuery->whereYear('pengadaan.created_at', $tahunAnggaran);
        }

        $statusPengadaanCounts = $statusPengadaanQuery
            ->selectRaw('count(*) as count')
            ->groupBy('pengadaan.status_id')
            ->get()
            ->pluck('count', 'status_id');

        // Memastikan setiap status pengadaan ada dalam data, meskipun nilainya nol
        $statusPengadaanChart = Status::all()->map(function ($status) use ($statusPengadaanCounts) {
            return [
                'label' => $status->nama_status,
                'count' => $statusPengadaanCounts->get($status->id, 0),
            ];
        });

        return view('pengadaan::unit.dashboard', [
            'tahunAnggaran' => $tahunAnggaran,
            'totalPengadaan' => $totalPengadaan,
            'pengadaanBerjalan' => $pengadaanBerjalan,
            'pengadaanSelesai' => $pengadaanSelesai,
            'jenisPengadaanChart' => $jenisPengadaanChart,
            'metodePengadaanChart' => $metodePengadaanChart,
            'statusPengadaanChart' => $statusPengadaanChart
        ]);
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

        // Ambil Pengadaan berdasarkan ID SubPerencanaan
        $pengadaan = Pengadaan::where('subperencanaan_id', $id)->first();

        // Status default jika tidak ada dalam database
        $status = 0; // Misalnya status 0 untuk 'Belum Dalam Periode'

        // Cek status yang ada di database
        if ($pengadaan && $pengadaan->status_id && in_array($pengadaan->status_id, [1, 2, 3, 4])) {
            $status = $pengadaan->status_id;
        }

        return view('pengadaan::unit.show', compact('subPerencanaan', 'status'));
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

        $formMode = 'edit';

        $pengadaan = Pengadaan::where('subperencanaan_id', $id)->first(); // Ambil data pengadaan terkait
        $pics = Pegawai::all(); // Ambil semua data PIC dari model Pegawai

        // Mengirim data catatan ke view jika status pengadaan adalah "Pemenuhan Dokumen"
        $catatan = ($pengadaan->status->nama_status == 'Pemenuhan Dokumen') ? $pengadaan->catatan : '-';

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
        $pengadaan = $subPerencanaan->pengadaan;

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
    
        // Ambil tahun anggaran dan verifikasi dari request
        $tahunAnggaran = $request->input('tahun_anggaran');
        $verifikasi = $request->input('verifikasi');
    
        // Query untuk mengambil data dari tabel sub_perencanaans berdasarkan unit_id
        $subPerencanaanQuery = SubPerencanaan::where('unit_id', $unitId)
            ->with(['pengadaan.status', 'perencanaan']); // Pastikan eager loading relasi perencanaan
    
        // Filter berdasarkan tahun anggaran jika ada input
        if ($tahunAnggaran) {
            $subPerencanaanQuery->whereHas('perencanaan', function ($query) use ($tahunAnggaran) {
                $query->where('tahun', $tahunAnggaran);
            });
        }
    
        // Filter berdasarkan verifikasi dokumen
        if ($verifikasi === 'terverifikasi') {
            $subPerencanaanQuery->whereHas('pengadaan', function ($query) {
                $query->where('status_id', Status::where('nama_status', 'Pemenuhan Dokumen')->first()->id)
                    ->whereNotNull('catatan'); // Cek apakah catatan dari PPK ada
            });
        } elseif ($verifikasi === 'belum_verifikasi') {
            $subPerencanaanQuery->whereHas('pengadaan', function ($query) {
                $query->where('status_id', Status::where('nama_status', 'Pemenuhan Dokumen')->first()->id)
                    ->whereNull('catatan'); // Cek apakah catatan dari PPK tidak ada
            });
        }
    
        $subPerencanaan = $subPerencanaanQuery->get();
        $status = Status::all();
    
        // Update status pengadaan untuk setiap subPerencanaan
        foreach ($subPerencanaan as $unit) {
            if ($unit->pengadaan) {
                $unit->pengadaan->checkAndUpdateStatus();
            }
        }
    
        // Kirim data ke view, termasuk tahun anggaran yang dipilih
        return view('pengadaan::unit.pengadaan', compact('subPerencanaan', 'status', 'tahunAnggaran', 'verifikasi'));
    }    

    public function listTemplateDokumen()
    {
        $templateDokumens = Document::all();
        return view('pengadaan::unit.template', compact('templateDokumens'));
    }
}
