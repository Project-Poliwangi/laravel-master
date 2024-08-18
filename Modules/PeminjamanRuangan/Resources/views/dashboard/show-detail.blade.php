@extends('peminjamanruangan::layouts.master')

@section('title', $title)
@section('content')
<div class="row">
    <div class="col-12">
        <div class="row align-items-center">
            <div class="col-sm-6 col-12">
                <h4 style="font-weight: bold" class="my-2">{{ strtoupper($title) }}</h4>
            </div>        
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Dokument Bukti</th>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $value)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $value->user->name }}</td>
                                <td>{{ $value->peminjam_nim }}</td>
                                <td>
                                    <a href="{{ asset('storage/images/uploads/'. $value->foto_selesai) }}" target="_blank">
                                        <img src="{{ asset('storage/images/uploads/'. $value->foto_selesai) }}" width="100" alt="">
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        @if($data->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data yang dapat ditampilkan</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection