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
        $documents = Document::all();

        return view('pengadaan::admin.keloladokumen', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $formMode = 'create';
        return view('pengadaan::admin.create', compact('formMode'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'nama_dokumen' => 'string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|mimes:doc,docx,xls,xlsx|max:10240',
        ]);

        // Proses file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/dokumen_template'), $fileName);
            $validatedData['file'] = $fileName;
        }

        // Simpan data ke database
        $document = new Document();
        $document->fill($validatedData);
        $document->save();

         return redirect('/admin/keloladokumen')->with('success', 'Dokumen berhasil ditambahkan.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $formMode = 'edit';
        $documents = Document::findOrFail($id);

        return view('pengadaan::admin.edit', compact('formMode','documents'));
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
            'file' => 'nullable|mimes:doc,docx,xls,xlsx|max:10240',
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
        return redirect('/admin/keloladokumen')->with('success_edit', 'Dokumen ' . $documents->nama_dokumen . ' berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $documents = Document::findOrFail($id);
        $documents->delete();
        return redirect('/admin/keloladokumen')->with('success_message', 'Berhasil dihapus!');
    }
}
