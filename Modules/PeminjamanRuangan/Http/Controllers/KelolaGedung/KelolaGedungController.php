<?php

namespace Modules\PeminjamanRuangan\Http\Controllers\KelolaGedung;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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
