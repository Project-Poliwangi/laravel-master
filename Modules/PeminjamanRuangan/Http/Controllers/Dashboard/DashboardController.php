<?php

namespace Modules\PeminjamanRuangan\Http\Controllers\Dashboard;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\PeminjamanRuangan\Entities\RuangPenggunaanKuliah;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if(auth()->user()->roles[0]->name == 'peminjam'){
            return redirect()->route('ruang.check');
        }
        
        $data = [
            'title' => 'Dashboard',
            'pending' => RuangPenggunaanKuliah::whereStatus('pending')->get()->count(),
            'history' => RuangPenggunaanKuliah::where('jadwal_mulai', '<', Carbon::today())->get()->count(),
            'approve' => RuangPenggunaanKuliah::whereStatus('pending')->get()->count(),
        ];

        return view('peminjamanruangan::dashboard.index', $data);
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
