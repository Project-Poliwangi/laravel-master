<?php

namespace Modules\Pengadaan\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Pengadaan\Entities\Document;
use Illuminate\Contracts\Support\Renderable;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $documents = Document::paginate(10);
        return view('pengadaan::admin.keloladokumen', compact('documents'));
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
        // Validasi input
        $validatedData = $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'file' => 'required|mimes:doc,docx|max:10240',
            'description' => 'nullable|string',
        ]);

        // Penanganan file yang diunggah
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $file_name = Str::random(20) . '.' . $extension;
            $file->storeAs('dokumen_template', $file_name, 'public');
            $validatedData['file'] = $file_name;
        }

        // Menyimpan data ke database
        Document::create($validatedData);

        return redirect('/admin/keloladokumen')->with('success', 'Dokumen berhasil diubah.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $documents = Document::findOrFail($id);

        // Validasi bahwa file adalah tipe doc atau docx
        $fileExtension = pathinfo($documents->file, PATHINFO_EXTENSION);
        if ($fileExtension !== 'doc' && $fileExtension !== 'docx') {
            abort(404);
        }

        // Ambil path ke file dokumen
        $filePath = public_path('storage/dokumen_template/' . $documents->file);

        // Kembalikan response untuk menampilkan file
        return response()->file($filePath);
        // return view('pengadaan::admin.show', compact('documents'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $documents = Document::findOrFail($id);

        return view('pengadaan::admin.edit', compact('documents'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $documents = Document::findOrFail($id);

        // Validasi data
        $validatedData = $request->validate([
            'nama_dokumen' => 'string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|mimes:doc,docx|max:10240',
        ]);

        // Proses file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/dokumen_template'), $fileName);
            $validatedData['file'] = $fileName;
        } else {
            $validatedData['file'] = $documents->file;
        }

        $documents->update($validatedData);

        // Redirect dengan pesan sukses
        return redirect('/admin/keloladokumen')->with('success', 'Dokumen ' . $documents->nama_dokumen . 'berhasil diperbarui.');
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
