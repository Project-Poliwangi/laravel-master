<?php

namespace Modules\PeminjamanRuangan\Http\Controllers\KelolaGedung;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Modules\PeminjamanRuangan\Entities\Gedung;

class KelolaGedungController extends Controller
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

        $query = Gedung::query();
        $dataGedung = $query->paginate($show);

        $data = [
            'title' => 'Data Gedung',
            'data' => $dataGedung,
            'show' => $show,
            'search' => $request->search,
            'paginate' => $query->paginate($show)
        ];

        return view('peminjamanruangan::kelola-gedung.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Gedung',
            'action' => route('gedung.store')
        ];

        return view('peminjamanruangan::kelola-gedung.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:gedungs,kode',
            'nama' => 'required',
            'lokasi' => 'required',
            'luas' => 'required|integer',
            'file' => 'required|max:1024|mimes:jpeg,jpg,png,heic,webp'
        ], [
            'kode.required' => 'Kode gedung wajib diisi',
            'kode.unique' => 'Kode gedung sudah terdaftar',
            'nama.required' => 'Nama gedung wajib diisi',
            'lokasi.required' => 'Lokasi gedung wajib diisi',
            'luas.required' => 'Luas gedung wajib diisi',
            'luas.integer' => 'Luas gedung harus berupa angka',
            'file.required' => 'Foto gedung wajib diisi',
            'file.mimes' => 'Foto gedung berupa salah satu dari jenis: jpg, jpeg, png, webp, heic',
            'file.max' => 'Foto gedung tidak boleh lebih dari 1 MB'
        ]);

        try {
            DB::beginTransaction();
            if($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = 'Gedung_'. rand(0, 999999999999) .'.'. $file->getClientOriginalExtension();
                $file->move(public_path('storage/images/gedungs/'), $filename);
            }

            $request->merge(['foto' => $filename]);
            Gedung::create($request->only('kode', 'nama', 'lokasi', 'foto', 'luas'));
            DB::commit();
            
            return redirect()->route('gedung')->with('success', 'Data gedung berhasil disimpan.');
        } catch(Exception $e) {
            abort(500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Gedung $gedung)
    {
        $data = [
            'title' => 'Ubah Gedung',
            'action' => route('gedung.update', $gedung->id),
            'gedung' => $gedung
        ];

        return view('peminjamanruangan::kelola-gedung.form', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Gedung $gedung)
    {
        $request->validate([
            'kode' => [
                'required',
                Rule::unique('gedungs', 'kode')->ignoreModel($gedung)
            ],
            'nama' => 'required',
            'lokasi' => 'required',
            'luas' => 'required|integer',
            'file' => 'max:1024|mimes:jpeg,jpg,png,heic,webp'
        ], [
            'kode.required' => 'Kode gedung wajib diisi',
            'kode.unique' => 'Kode gedung sudah terdaftar',
            'nama.required' => 'Nama gedung wajib diisi',
            'lokasi.required' => 'Lokasi gedung wajib diisi',
            'luas.required' => 'Luas gedung wajib diisi',
            'luas.integer' => 'Luas gedung harus berupa angka',
            'file.required' => 'Foto gedung wajib diisi',
            'file.mimes' => 'Foto gedung berupa salah satu dari jenis: jpg, jpeg, png, webp, heic',
            'file.max' => 'Foto gedung tidak boleh lebih dari 1 MB'
        ]);

        try {
            DB::beginTransation();
            if($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = 'Gedung_'. rand(0, 999999999999) .'.'. $file->getClientOriginalExtension();
                $file->move(public_path('storage/images/gedungs/'), $filename);

                if(file_exists(public_path('storage/images/gedungs/'. $gedung->foto))) {
                    File::delete(public_path('storage/images/gedungs/'. $gedung->foto));
                }
            } else {
                $filename = $gedung->foto;
            }

            $request->merge(['foto' => $filename]);
            $gedung->update($request->only('kode', 'nama', 'lokasi', 'foto', 'luas'));
            DB::commit();
            
            return redirect()->route('gedung')->with('success', 'Data gedung berhasil disimpan.');
        } catch(Exception $e) {
            abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Gedung $gedung)
    {
        try {
            $gedung->delete();

            return redirect()->route('gedung')->with('success', 'Data gedung berhasil dihapus.');
        } catch(Exception $e) {
            abort(500);
        }
    }
}
