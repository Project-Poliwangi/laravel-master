<?php

namespace Modules\Pengadaan\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PPKController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('pengadaan::index');
    }

    public function daftarpermohonan()
    {
        return view('pengadaan::ppk.permohonan');
    }

    public function permohonandiproses()
    {
        return view('pengadaan::ppk.diproses');
    }

    public function permohonanselesai()
    {
        return view('pengadaan::ppk.selesai');
    }

    public function penetapan()
    {
        return view('pengadaan::ppk.penetapan');
    }

    public function kontrak()
    {
        return view('pengadaan::ppk.kontrak');
    }

    public function serahterima()
    {
        return view('pengadaan::ppk.serahterima');
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
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('pengadaan::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('pengadaan::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
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
