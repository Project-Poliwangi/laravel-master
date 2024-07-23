<?php

namespace Modules\PeminjamanRuangan\Http\Controllers\Ruang;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\PeminjamanRuangan\Entities\Ruang;
use Modules\PeminjamanRuangan\Entities\RuangPenggunaanKuliah;

class RuangController extends Controller
{
    public function checkRuangan()
    {
        $data = [
            'title' => 'Cek Ruangan'
        ];

        return view('peminjamanruangan::ruang.cek-ruangan', $data);
    }

    public function checkKodeQR($kode)
    {
        $dataRuang = RuangPenggunaanKuliah::whereHas('ruang', function($q) use ($kode) {
            $q->where('kode_qr', $kode);
        })->first();

        if(!is_null($dataRuang)) {
            $dataRuang->jadwal_mulai = Carbon::parse($dataRuang->jadwal_mulai)->format('d M Y');
            $dataRuang->jadwal_akhir = Carbon::parse($dataRuang->jadwal_akhir)->format('d M Y');
            $dataRuang->waktu_pinjam = Carbon::parse($dataRuang->waktu_pinjam)->format('H.i');
            $dataRuang->waktu_selesai = Carbon::parse($dataRuang->waktu_selesai)->format('H.i');
            $data = [
                'title' => 'Detail Ruangan',
                'ruang' => $dataRuang
            ];

            return view('peminjamanruangan::ruang.detail', $data);
        } else {
            return redirect()->route('ruang.check')->withErrors(['kode' => 'Kode QR tidak valid!']);
        }
    }

    public function ruanganTersedia()
    {
        $dataRuangTerpakai = Ruang::whereHas('ruangPenggunaanKuliah', function($q) {
            $date = Carbon::now();
            $q->whereStatus('approve');
            $q->whereDate('jadwal_mulai', $date->format('Y-m-d'));
            $q->whereTime('jadwal_mulai', '<=', $date->format('H:i:s'));
            $q->whereTime('jadwal_akhir', '>=', $date->format('H:i:s'));
        })->pluck('id')->all();

        $data = [
            'title' => 'Ruangan Tersedia',
            'ruangs' => Ruang::whereNotIn('id', $dataRuangTerpakai)->get()
        ];

        return view('peminjamanruangan::ruang.daftar-ruangan', $data);
    }

    public function ruanganTerpakai()
    {
        $data = [
            'title' => 'Ruangan Terpakai',
            'type' => 'terpakai',
            'ruangs' => Ruang::whereHas('ruangPenggunaanKuliah', function($q) {
                $date = Carbon::now();
                $q->whereStatus('approve');
                $q->whereDate('jadwal_mulai', $date->format('Y-m-d'));
                $q->whereTime('jadwal_mulai', '<=', $date->format('H:i:s'));
                $q->whereTime('jadwal_akhir', '>=', $date->format('H:i:s'));
            })->get()
        ];

        return view('peminjamanruangan::ruang.daftar-ruangan', $data);
    }
}
