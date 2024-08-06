@extends('peminjamanruangan::layouts.master')

@section('title', $title)
@section('content')
    <div class="row mb-3">
        <div class="col-sm-6 col-12">
            <h4 style="font-weight: bold" class="my-2">{{ strtoupper($title) }}</h4>
        </div>
        <div class="col-sm-6 col-12">
            <div class="col-md-6 col-sm-8 ml-auto">
                <div class="d-flex align-items-center my-2 small">
                    <div style="font-weight: bold;white-space: nowrap">Search :</div>
                    <input type="text" name="search" value=""
                        class="form-control ml-2" style="border-radius: 60px;">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($ruangs as $ruang)
            <div class="col-md-4 col-sm-6 col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 style="font-weight: bold">{{ $ruang->nama }}</h5>
                        <hr>
                        <div class="d-flex align-items-center justify-content-center border bg-light" style="height: 350px;border-radius: 8px;overflow: hidden">
                            <img src="{{ asset('storage/images/ruangs/'. $ruang->foto) }}" width="100%" alt="">
                        </div>
                    </div>
                    <div class="d-flex w-100 border">
                        <a href="{{ route('ruang.detail', $ruang->id) }}" class="btn {{ isset($type) && $type == 'terpakai' ? 'btn-success' : 'btn-primary' }} w-50 py-2 border" style="border-radius: 0;">Detail</a>
                        <a href="{{ route('ruang.create-peminjaman', $ruang->id) }}" class="btn {{ isset($type) && $type == 'terpakai' ? 'btn-success' : 'btn-primary' }} w-50 py-2 border" style="border-radius: 0;">{{ isset($type) && $type == 'terpakai' ? 'Pengguna' : 'Pinjam' }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection