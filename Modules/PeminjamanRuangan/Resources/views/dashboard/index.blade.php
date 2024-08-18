@extends('adminlte::page')

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
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <h2 class="text-center" style="font-weight: bold">APLIKASI TATA KELOLA RUANGAN</h1>
        <h4 class="text-center mb-5">Selamat Datang, Pengelola</h4>
        <div class="row">
            <div class="col-md-4 col-sm-6 col-12">
                <div class="card shadow-sm bg-info text-white" style="height: 100%">
                    <div class="card-body">
                        <h1 style="font-weight: bold;font-size: 2.5rem">Persetujuan Peminjaman</h1>
                        <br>
                        <br>
                        <h2 class="text-right">{{ $pending }} Permohonan</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="card shadow-sm bg-success text-white" style="height: 100%">
                    <div class="card-body">
                        <h1 style="font-weight: bold;font-size: 2.5rem">Riwayat Peminjaman</h1>
                        <br>
                        <br>
                        <h2 class="text-right">{{ $history }} Permohonan</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <a href="{{ route('home.proof-documents') }}" class="card shadow-sm bg-warning text-white" style="height: 100%">
                    <div class="card-body">
                        <h1 style="font-weight: bold;font-size: 2.5rem">Dokumen Bukti</h1>
                        <br>
                        <br>
                        <h2 class="text-right">{{ $approve }} Permohonan</h2>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection