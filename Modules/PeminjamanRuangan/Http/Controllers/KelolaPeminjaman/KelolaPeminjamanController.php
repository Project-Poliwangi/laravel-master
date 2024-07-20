<?php

namespace Modules\PeminjamanRuangan\Http\Controllers\KelolaPeminjaman;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\PeminjamanRuangan\Entities\RuangPenggunaanKuliah;

class KelolaPeminjamanController extends Controller
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

        $ruangPenggunaanKuliah = RuangPenggunaanKuliah::paginate($show)->map(function($item) {
            $item->jadwal_mulai = Carbon::parse($item->jadwal_mulai)->format('d M Y');
            $item->jadwal_akhir = Carbon::parse($item->jadwal_akhir)->format('d M Y');
            $item->waktu_pinjam = Carbon::parse($item->waktu_pinjam)->format('H:i');
            $item->waktu_selesai = Carbon::parse($item->waktu_selesai)->format('H:i');
            return $item;
        });

        $data = [
            'title' => 'Data Peminjam',
            'data' => $ruangPenggunaanKuliah,
            'show' => $show,
            'search' => $request->search,
            'paginate' => RuangPenggunaanKuliah::paginate($show)
        ];

        return view('peminjamanruangan::kelola-peminjaman.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('peminjamanruangan::create');
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
        return view('peminjamanruangan::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('peminjamanruangan::edit');
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
