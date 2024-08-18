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
            'approve' => RuangPenggunaanKuliah::whereStatus('approve')->whereNotNull('foto_selesai')->get()->count(),
        ];

        return view('peminjamanruangan::dashboard.index', $data);
    }

    public function detailProof() {
        $data = [
            'title' => 'Dokumen Bukti',
            'data' => RuangPenggunaanKuliah::whereStatus('approve')->whereNotNull('foto_selesai')->get()
        ];

        return view('peminjamanruangan::dashboard.show-detail', $data);
    }
}
