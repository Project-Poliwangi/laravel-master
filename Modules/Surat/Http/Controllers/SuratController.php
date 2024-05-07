<?php

namespace Modules\Surat\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Surat\Entities\Surat;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $surat = Surat::all();
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
            'users_id'=> auth()->user()->id,
            'no_surat'=> $request->no_surat,
            'pengirim'=> $request->pengirim,
            'perihal'=> $request->perihal,
            'tanggal_surat'=> $request->tanggal_surat,
            'status'=> $request->status,
            'foto_surat'=> $request->foto_surat,
            'foto_disposisi'=> $request->foto_disposisi,
            'tujuan_disposisi'=> $request->tujuan_disposisi,
        ];
        Surat::create($data);
        return redirect('/surat/surat-masuk')->with('success_message', 'Surat added!');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('surat::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('surat::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        
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
