@extends('peminjamanruangan::layouts.master')

@section('title', $title)
@section('content')
    <div class="row mb-3">
        <div class="col-sm-12 col-12">
            <h4 style="font-weight: bold" class="my-5"></h4>
        </div>
        <div class="col-md-6 col-sm-10 col-12">
            <div class="card shadow-sm mb-3">
                <div class="card-body p-5">
                    <div class="alert alert-info mx-auto col-md-4 col-sm-8 col-12">{{ $ruang->ruang->jenis }} {{ $ruang->ruang->nama }}</div>
                    <div style="overflow: hidden;border-radius: 10px;" class="border mb-3">
                        <img src="{{ asset('storage/images/ruangs/'. $ruang->ruang->foto) }}" width="100%" alt="">
                    </div>
                    <table class="table mb-4">
                        <tr>
                            <th>Kode</th>
                            <td>: {{  $ruang->ruang->kode_bmn }}</td>
                        </tr>
                        <tr>
                            <th>Program Studi</th>
                            <td>: {{  $ruang->programStudi->nama }}</td>
                        </tr>
                        <tr>
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
                        </tr>
                    </table>
                    <div class="col-12 text-center">
                        <a href="{{ route('ruang.check') }}" class="btn btn-info px-5">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
