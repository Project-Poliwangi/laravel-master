@extends('peminjamanruangan::layouts.master')

@section('title', $title)
@section('content')
    <div class="row mb-3">
        <div class="col-sm-12 col-12">
            <h4 style="font-weight: bold" class="my-5"></h4>
        </div>
        <div class="col-md-5 col-sm-10 col-12">
            <div class="card shadow-sm mb-3">
                <div class="card-body p-5">
                    <div class="alert alert-info mx-auto col-md-4 col-sm-8 col-12 text-center">{{ $ruang->jenis }} {{ $ruang->nama }}</div>
                    <div style="overflow: hidden;border-radius: 10px;height: 350px" class="border mb-3">
                        <img src="{{ asset('storage/images/ruangs/'. $ruang->foto) }}" width="100%" alt="">
                    </div>
                    <table class="table mb-4">
                        <tr>
                            <th width="25%">Kode</th>
                            <td>: {{  $ruang->kode_bmn }}</td>
                        </tr>
                        <tr>
                            <th>Gedung</th>
                            <td>: {{  $ruang->gedung->kode }} - {{  $ruang->gedung->nama }}</td>
                        </tr>
                        <tr>
                            <th>Lantai</th>
                            <td>: {{  $ruang->lantai }}</td>
                        </tr>
                        <tr>
                            <th>Luas</th>
                            <td>: {{  $ruang->luas }} M<sup>2</sup></td>
                        </tr>
                        <tr>
                            <th>Kapasitas</th>
                            <td>: {{  $ruang->luas }} Orang</td>
                        </tr>
                        <tr>
                            <th></th>
                            <td><img src="{{ generateQrCode($ruang->kode_qr) }}" width="150" alt=""></td>
                        </tr>
                        {{-- <tr>
                            <th>Program Studi</th>
                            <td>: {{  $ruang->ruangPenggunaanKuliah[0]->nama }}</td>
                        </tr> --}}
                        {{-- <tr>
                            <th>NIM</th>
                            <td>: {{  $ruang->peminjam_nim }}</td>
                        </tr>
                        <tr>
                            <th>Jadwal Mulai</th>
                            <td>: {{  $ruang->jadwal_mulai }}</td>
                        </tr>
                        <tr>
                            <th>Jadwal Selesai</th>
                            <td>: {{  $ruang->jadwal_akhir }}</td>
                        </tr>
                        <tr>
                            <th>Waktu Pinjam</th>
                            <td>: {{  $ruang->waktu_pinjam }}</td>
                        </tr>
                        <tr>
                            <th>Waktu Selesai</th>
                            <td>: {{  $ruang->waktu_selesai }}</td>
                        </tr> --}}
                    </table>
                    <div class="col-12 text-center">
                        @if($status)
                            <a href="javascript:history.back()" class="btn btn-info px-5">Close</a>
                        @else
                            <a href="javascript:history.back()" class="btn btn-secondary px-5">Close</a>
                            <a href="{{ route('ruang.create-peminjaman', $ruang->id) }}" class="btn btn-info px-5">Pinjam</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
