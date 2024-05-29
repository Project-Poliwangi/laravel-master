<?php

namespace Modules\Surat\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Modules\Surat\Entities\SuratMasuk;
use Illuminate\Contracts\Support\Renderable;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $surat = SuratMasuk::all();
        return view('surat::surat.index',compact('surat'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('surat::surat.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $data = [
            'induk'=> $request->induk,
            'nomor'=> $request->nomor,
            'tanggal_surat'=> $request->tanggal_surat,
            'tanggal_diterima'=> $request->tanggal_diterima,
            'pengirim'=> $request->pengirim,
            'diterima_dari'=> $request->diterima_dari,
            'perihal'=> $request->perihal,
            'sifat'=> $request->sifat,
            'user_id'=> auth()->user()->id,
            'catatan_sekretariat'=> $request->catatan_sekretariat,
        ];
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $file_name = Str::random(20) . '.' . $extension;
            $file->storeAs('/assets/img/surat', $file_name, 'public');
            $data['file'] = $file_name;
        }
        // $data = [
        //     'users_id'=> auth()->user()->id,
        //     'no_surat'=> $request->no_surat,
        //     'pengirim'=> $request->pengirim,
        //     'perihal'=> $request->perihal,
        //     'tanggal_surat'=> $request->tanggal_surat,
        //     'status'=> $request->status,
        //     'foto_surat'=> $request->foto_surat,
        //     'foto_disposisi'=> $request->foto_disposisi,
        //     'tujuan_disposisi'=> $request->tujuan_disposisi,
        // ];
        // dd($data);
        SuratMasuk::create($data);
        return redirect('/surat/surat-masuk')->with('success_message', 'Surat added!');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        return view('surat::surat.show',compact('surat'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $suratmasuk = SuratMasuk::findOrFail($id);
        return view('surat::surat.edit', compact('suratmasuk'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $Surat_masuk = SuratMasuk::findOrFail($id);
        $data = [
            'induk'=> $request->induk,
            'nomor'=> $request->nomor,
            'tanggal_surat'=> $request->tanggal_surat,
            'tanggal_diterima'=> $request->tanggal_diterima,
            'pengirim'=> $request->pengirim,
            'diterima_dari'=> $request->diterima_dari,
            'perihal'=> $request->perihal,
            'sifat'=> $request->sifat,
            'user_id'=> auth()->user()->id,
            'catatan_sekretariat'=> $request->catatan_sekretariat,
        ];
        if (!empty($request->hasFile('file'))) {
            $destination = '/storage/app/public/assets/img/surat/' . $Surat_masuk->file;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $file_name = Str::random(20) . '.' . $extension;
            $file->storeAs('/assets/img/surat', $file_name, 'public');
            $data['file'] = $file_name;
        }
        
        $Surat_masuk->update($data);
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
