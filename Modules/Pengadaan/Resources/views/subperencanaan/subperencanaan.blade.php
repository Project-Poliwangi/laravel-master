@extends('adminlte::page')

@section('title', 'Daftar Sub Perencanaan')

@section('content_header')
    <h1 class="m-0 text-dark text-center">Daftar Sub Perencanaan</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('/subperencanaan/create') }}" class="btn btn-success btn-sm"
                            title="Tambah Sub Perencanaan">
                            <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                        </a>

                        <form method="GET" action="{{ url('/subperencanaan/index') }}" accept-charset="UTF-8"
                            class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Cari..."
                                    value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br />
                        <br />

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>Perencanaan</th>
                                        <th>Kegiatan</th>
                                        <th>Jenis Pengadaan</th>
                                        <th>Unit</th>
                                        <th colspan="3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subperencanaan as $sub)
                                        <tr class="text-center">
                                            <td id="nama_perencanaan_{{ $sub->id }}">{{ $sub->perencanaans->nama }}
                                            </td>
                                            <td id="kegiatan_{{ $sub->id }}">{{ $sub->kegiatan }}</td>
                                            <td id="jenis_pengadaan_{{ $sub->id }}">
                                                {{ $sub->jenisPengadaans->nama_jenis }}</td>
                                            <td id="unit_{{ $sub->unit }}">{{ $sub->unit->nama }}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <button
                                                        onclick="window.location.href='{{ url('/subperencanaan/show/' . $sub->id) }}'"
                                                        title="Detail" class="btn btn-info btn-sm mr-1">
                                                        <i class="fas fa-eye" aria-hidden="true"></i>
                                                    </button>

                                                    <button
                                                        onclick="window.location.href='{{ url('/subperencanaan/edit/' . $sub->id) }}'"
                                                        title="Edit" class="btn btn-warning btn-sm mr-1">
                                                        <i class="fas fa-pencil" aria-hidden="true"></i>
                                                    </button>

                                                    <form action="{{ url('/subperencanaan/destroy/' . $sub->id) }}"
                                                        method="POST" accept-charset="UTF-8" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="Hapus" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus perencanaan ini?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {!! $subperencanaan->links('pagination::bootstrap-4') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@stop
