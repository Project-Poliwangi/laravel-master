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
                    <a href="{{ url('pengadaan/unit/create') }}" class="btn btn-success btn-sm" title="Tambah Permohonan">
                        <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                    </a>

                    <form method="GET" action="{{ url('/pengadaan/unit/permohonan') }}" accept-charset="UTF-8"
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
                                    @foreach ($unit as $pengadaans)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pengadaans->nomor_surat }}</td>
                                            <td>{{ $pengadaans->jenis_pengadaan }}</td>
                                            <td>{{ $pengadaans->total_biaya }}</td>
                                            <td><a href="{{ url('/pengadaan/unit/' . $pengadaans->id) }}"
                                                    title="View Dokumen" class="btn icon icon-left btn-secondary btn-sm"><i
                                                        class="bi bi-eye"></i> Lihat</a></td>
                                            <td>
                                                <a href="{{ url('/pengadaan/edit/' . $pengadaans->id) }}" title="Edit"
                                                    class="btn icon icon-left btn-primary btn-sm"><i
                                                        class="bi bi-pencil"></i> Edit</a>
                                                <form action="{{ url('/pengadaan/delete/' . $pengadaans->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Delete"
                                                        class="btn icon icon-left btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus pengadaan ini?')">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endsection
