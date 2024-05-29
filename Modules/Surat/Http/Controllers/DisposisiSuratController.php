<?php

namespace Modules\Surat\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Modules\Surat\Entities\SuratMasuk;
use Modules\Surat\Entities\SuratDisposisi;
use Illuminate\Contracts\Support\Renderable;

class DisposisiSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $disposisi = SuratDisposisi::with('surat_masuk')->get();
        return view('surat::disposisi-surat.index',compact('disposisi'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $disposisi_surat = SuratMasuk::all();
        return view('surat::disposisi-surat.create',compact('disposisi_surat'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $data = [
            'surat_masuk_id'=> $request->surat_masuk_id,
            'induk'=> $request->induk,
            'waktu'=> $request->waktu,
            'disposisi_singkat'=> $request->disposisi_singkat,
            'disposisi_narasi'=> $request->disposisi_narasi,
            'jenis'=> $request->jenis,
            'status'=> $request->status,
        ];
        if ($request->hasFile('lampiran_tindak_lanjut')) {
            $file = $request->file('lampiran_tindak_lanjut');
            $extension = $file->getClientOriginalExtension();
            $file_name = Str::random(20) . '.' . $extension;
            $file->storeAs('/assets/img/disposisi', $file_name, 'public');
            $data['lampiran_tindak_lanjut'] = $file_name;
        }
        SuratDisposisi::create($data);
        return redirect('surat/disposisi-surat/')->with('success_message','Disposisi Added!');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $disposisi = SuratDisposisi::with('surat_masuk')->findOrFail($id);
        return view('surat::disposisi-surat.show',compact('disposisi'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $disposisi = SuratDisposisi::with('surat_masuk')->findOrFail($id);
        $surat_masuk = SuratMasuk::all();
        return view('surat::disposisi-surat.edit',compact('surat_masuk','disposisi'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $surat_disposisi = SuratDisposisi::findOrFail($id);
        $data = [
            'surat_masuk_id'=> $request->surat_masuk_id,
            'induk'=> $request->induk,
            'waktu'=> $request->waktu,
            'disposisi_singkat'=> $request->disposisi_singkat,
            'disposisi_narasi'=> $request->disposisi_narasi,
            'jenis'=> $request->jenis,
            'status'=> $request->status,
        ];
        if (!empty($request->hasFile('lampiran_tindak_lanjut'))) {
            $destination = '/storage/app/public/assets/img/disposisi/' . $surat_disposisi->lampiran_tindak_lanjut;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('lampiran_tindak_lanjut');
            $extension = $file->getClientOriginalExtension();
            $file_name = Str::random(20) . '.' . $extension;
            $file->storeAs('/assets/img/disposisi', $file_name, 'public');
            $data['lampiran_tindak_lanjut'] = $file_name;
        }  
        $surat_disposisi->update($data);
        return back();
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
