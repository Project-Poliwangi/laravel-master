<?php

namespace Modules\PeminjamanRuangan\Http\Controllers\KelolaMataKuliah;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Modules\PeminjamanRuangan\Entities\MataKuliah;
use Modules\PeminjamanRuangan\Entities\ProgramStudi;

class KelolaMataKuliahController extends Controller
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

        $query = MataKuliah::query();
        $dataMataKuliah = $query->paginate($show);

        $data = [
            'title' => 'Data Mata Kuliah',
            'data' => $dataMataKuliah,
            'show' => $show,
            'search' => $request->search,
            'paginate' => $query->paginate($show)
        ];

        return view('peminjamanruangan::kelola-mata-kuliah.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Mata Kuliah',
            'action' => route('mata-kuliah.store'),
            'programStudis' => ProgramStudi::all()
        ];

        return view('peminjamanruangan::kelola-mata-kuliah.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:mata_kuliahs,kode',
            'program_studi_id' => 'required',
            'nama' => 'required',
            'jenis' => 'required',
            'sks' => 'required|integer'
        ], [
            'kode.required' => 'Kode Mata Kuliah wajib diisi',
            'kode.unique' => 'Kode Mata Kuliah sudah terdaftar',
            'nama.required' => 'Nama Mata Kuliah wajib diisi',
            'jenis.required' => 'Jenis Mata Kuliah wajib diisi',
            'sks.required' => 'Jumlah sks harus diisi',
            'sks.integer' => 'Jumlah sks harus berupa angka'
        ]);

        try {
            DB::beginTransaction();
            MataKuliah::create($request->only(['kode', 'program_studi_id', 'nama', 'jenis', 'sks']));
            DB::commit();

            return redirect()->route('mata-kuliah')->with('success', 'Data mata kuliah berhasil disimpan.');
        } catch(Exception $e) {
            abort(500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(MataKuliah $mataKuliah)
    {
        $data = [
            'title' => 'Ubah Mata Kuliah',
            'action' => route('mata-kuliah.update', $mataKuliah->id),
            'mataKuliah' => $mataKuliah,
            'programStudis' => ProgramStudi::all()
        ];

        return view('peminjamanruangan::kelola-mata-kuliah.form', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, MataKuliah $mataKuliah)
    {
        $request->validate([
            'kode' => [
                'required',
                Rule::unique('mata_kuliahs', 'kode')->ignoreModel($mataKuliah)
            ],
            'program_studi_id' => 'required',
            'nama' => 'required',
            'jenis' => 'required',
            'sks' => 'required|integer'
        ], [
            'kode.required' => 'Kode Mata Kuliah wajib diisi',
            'kode.unique' => 'Kode Mata Kuliah sudah terdaftar',
            'nama.required' => 'Nama Mata Kuliah wajib diisi',
            'jenis.required' => 'Jenis Mata Kuliah wajib diisi',
            'sks.required' => 'Jumlah sks harus diisi',
            'sks.integer' => 'Jumlah sks harus berupa angka'
        ]);

        try {
            DB::beginTransaction();
            $mataKuliah->update($request->only(['kode', 'program_studi_id', 'nama', 'jenis', 'sks']));
            DB::commit();

            return redirect()->route('mata-kuliah')->with('success', 'Data mata kuliah berhasil disimpan.');
        } catch(Exception $e) {
            abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(MataKuliah $mataKuliah)
    {
        try {
            $mataKuliah->delete();

            return redirect()->route('mata-kuliah')->with('success', 'Data mata kuliah berhasil dihapus.');
        } catch(Exception $e) {
            abort(500);
        }
    }
}
