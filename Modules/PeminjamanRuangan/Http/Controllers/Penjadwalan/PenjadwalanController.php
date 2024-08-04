<?php

namespace Modules\PeminjamanRuangan\Http\Controllers\Penjadwalan;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\PeminjamanRuangan\Entities\JadwalKuliah;
use Modules\PeminjamanRuangan\Entities\MataKuliah;
use Modules\PeminjamanRuangan\Entities\Pegawai;
use Modules\PeminjamanRuangan\Entities\ProgramStudi;
use Modules\PeminjamanRuangan\Entities\Ruang;

class PenjadwalanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $show = 10;
        if($request->has('show')) {
            $show = $request->show;
        }

        $query = JadwalKuliah::query();
        $dataPenjadwalan = $query->paginate($show);

        $data = [
            'title' => 'Penjadwalan Pengguna',
            'data' => $dataPenjadwalan,
            'show' => $show,
            'search' => $request->search,
            'paginate' => $query->paginate($show)
        ];

        return view('peminjamanruangan::penjadwalan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Penjadwalan',
            'matakuliahs' => MataKuliah::all(),
            'programStudis' => ProgramStudi::all(),
            'pegawais' => Pegawai::all(),
            'ruangs' => Ruang::all(),
            'action' => route('penjadwalan.store')
        ];

        return view('peminjamanruangan::penjadwalan.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'mata_kuliah_id' => 'required',
            'semester' => 'required',
            'kelas' => 'required',
            'program_studi_id' => 'required',
            'dosen_id' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'ruang_id' => 'required',
        ], [
            'mata_kuliah_id.required' => 'Mata Kuliah wajib diisi',
            'semester.required' => 'Semester wajib diisi',
            'kelas.required' => 'Kelas wajib diisi',
            'program_studi_id.required' => 'Program Studi wajib diisi',
            'dosen_id.required' => 'Dosen wajib diisi',
            'hari.required' => 'Hari wajib diisi',
            'jam_mulai.required' => 'Jam Mulai wajib diisi',
            'jam_selesai.required' => 'Jam Selesai wajib diisi',
            'ruang_id.required' => 'Ruang wajib diisi',
        ]);

        try {
            JadwalKuliah::create($request->only(['mata_kuliah_id', 'semester', 'kelas', 'program_studi_id', 'dosen_id', 'hari', 'jam_mulai', 'jam_selesai', 'ruang_id', 'description']));
            return redirect()->route('penjadwalan')->with('success', 'Data penjadwalan berhasil disimpan');
        } catch(Exception $e) {
            echo response()->json($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(JadwalKuliah $jadwalKuliah)
    {
        $data = [
            'title' => 'Ubah Penjadwalan',
            'matakuliahs' => MataKuliah::all(),
            'programStudis' => ProgramStudi::all(),
            'pegawais' => Pegawai::all(),
            'ruangs' => Ruang::all(),
            'action' => route('penjadwalan.update', $jadwalKuliah->id),
            'data' => $jadwalKuliah
        ];

        return view('peminjamanruangan::penjadwalan.form', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, JadwalKuliah $jadwalKuliah)
    {
        $request->validate([
            'mata_kuliah_id' => 'required',
            'semester' => 'required',
            'kelas' => 'required',
            'program_studi_id' => 'required',
            'dosen_id' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'ruang_id' => 'required',
        ], [
            'mata_kuliah_id.required' => 'Mata Kuliah wajib diisi',
            'semester.required' => 'Semester wajib diisi',
            'kelas.required' => 'Kelas wajib diisi',
            'program_studi_id.required' => 'Program Studi wajib diisi',
            'dosen_id.required' => 'Dosen wajib diisi',
            'hari.required' => 'Hari wajib diisi',
            'jam_mulai.required' => 'Jam Mulai wajib diisi',
            'jam_selesai.required' => 'Jam Selesai wajib diisi',
            'ruang_id.required' => 'Ruang wajib diisi',
        ]);

        try {
            $jadwalKuliah->update($request->only(['mata_kuliah_id', 'semester', 'kelas', 'program_studi_id', 'dosen_id', 'hari', 'jam_mulai', 'jam_selesai', 'ruang_id', 'description']));
            return redirect()->route('penjadwalan')->with('success', 'Data penjadwalan berhasil disimpan');
        } catch(Exception $e) {
            echo response()->json($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(JadwalKuliah $jadwalKuliah)
    {
        try {
            $jadwalKuliah->delete();
            return redirect()->route('penjadwalan')->with('success', 'Data penjadwalan berhasil dihapus');
        } catch(Exception $e) {
            echo response()->json($e->getMessage());
        }
    }
}
