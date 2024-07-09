@extends('adminlte::page')
@section('title', 'Daftar Permohonan')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Daftar Permohonan Pengadaan</div>
                <div class="card-body">
                    <a href="{{ url('/unit/create') }}" class="btn btn-success btn-sm" title="Tambah Permohonan">
                        <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                    </a>

                    <form method="GET" action="{{ url('/unit') }}" accept-charset="UTF-8"
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
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Surat</th>
                                        <th>Jenis Pengadaan</th>
                                        <th>Total Biaya</th>
                                        <th>Dokumen</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengadaan as $unit)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $unit->nomor_surat }}</td>
                                            <td>{{ $unit->jenis_pengadaan }}</td>
                                            <td>{{ $unit->total_biaya }}</td>
                                            <td>
                                                <a href="{{ url('/unit/show/' . $unit->id) }}" title="Lihat Dokumen"
                                                    class="btn icon icon-left btn-secondary btn-sm"><i
                                                        class="fa fa-eye"></i> Lihat</a>
                                            </td>
                                            <td>
                                                <a href="{{ url('unit/edit/' . $unit->id) }}" title="Edit"
                                                    class="btn icon icon-left btn-primary btn-sm"><i
                                                        class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                                                <form action="{{ url('/unit/destroy/' . $unit->id) }}" method="POST"
                                                    accept-charset="UTF-8" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Delete"
                                                        class="btn icon icon-left btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus pengadaan ini?')">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex">
                                {!! $pengadaan->links('pagination::bootstrap-4') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection
