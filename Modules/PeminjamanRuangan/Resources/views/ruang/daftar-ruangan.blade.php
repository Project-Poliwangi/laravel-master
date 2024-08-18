@extends('peminjamanruangan::layouts.master')

@section('title', $title)
@section('content')
    <div class="row mb-3">
        <div class="col-sm-6 col-12">
            <h4 style="font-weight: bold" class="my-2">{{ strtoupper($title) }}</h4>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-6"></div>
                <div class="col-sm-6 col-12">
                    <form action="">
                        <div class="row align-items-center">
                            <div class="col-md-6 col-8 ml-auto">
                                <div class="d-flex align-items-center my-2 small">
                                    <div style="font-weight: bold;white-space: nowrap">Search :</div>
                                    <input type="text" name="search" value="{{ $search }}"
                                        class="form-control ml-2" style="border-radius: 60px;">
                                </div>
                            </div>
                            <div class="col-md-3 col-2">
                                <input type="datetime-local" name="date" value="{{ $date }}" class="form-control" onChange="this.form.submit()">
                            </div>
                            <div class="col-md-3 col-2">
                                <select name="gedung_id" class="form-control" onChange="this.form.submit()">
                                    <option value="">All</option>
                                    @foreach($gedungs as $gedung)
                                        <option value="{{ $gedung->id }}" @if($gedung_id == $gedung->id) selected @endif>{{ $gedung->kode }} - {{ $gedung->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>No.</th>
                            <th>Kode Ruangan</th>
                            <th>Nama Ruangan</th>
                            <th width="200"></th>
                        </thead>
                        <tbody>
                            @foreach($ruangs as $ruang)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ruang->kode_bmn }}</td> 
                                    <td>{{ $ruang->gedung->nama }} - {{ $ruang->nama }}</td>
                                    <td>
                                        <a href="{{ route('ruang.detail', $ruang->id) }}" class="btn {{ isset($type) && $type == 'terpakai' ? 'btn-success' : 'btn-primary' }}">Detail</a>
                                        @if(isset($type) && $type == 'terpakai')
                                        <button class="btn btn-secondary" data-toggle="modal" data-target="#myModal{{ $ruang->id }}">Pengguna</button>
                                        <div class="modal fade" id="myModal{{ $ruang->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5>Detail Pengguna</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>Nama</th>
                                                                <td>: {{ $ruang->nama_user }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>NIM</th>
                                                                <td>: {{ $ruang->peminjam_nim }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Username</th>
                                                                <td>: {{ $ruang->username_user }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Email</th>
                                                                <td>: {{ $ruang->email_user ?? '-' }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <a href="{{ isset($type) && $type == 'terpakai' ? route('ruang.detail', $ruang->id) : route('ruang.create-peminjaman', $ruang->id) }}" class="btn {{ isset($type) && $type == 'terpakai' ? 'btn-secondary' : 'btn-secondary' }}">{{ isset($type) && $type == 'terpakai' ? 'Pengguna' : 'Pinjam' }}</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row">
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
                        <a href="{{ isset($type) && $type == 'terpakai' ? route('ruang.detail', $ruang->id) : route('ruang.create-peminjaman', $ruang->id) }}" class="btn {{ isset($type) && $type == 'terpakai' ? 'btn-success' : 'btn-primary' }} w-50 py-2 border" style="border-radius: 0;">{{ isset($type) && $type == 'terpakai' ? 'Pengguna' : 'Pinjam' }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div> --}}
@endsection