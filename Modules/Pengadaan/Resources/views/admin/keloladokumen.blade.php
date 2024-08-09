@extends('adminlte::page')
@section('title', 'Kelola Dokumen')
@section('content_header')
    <h1 class="m-0 text-dark">Template Dokumen Pengadaan</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header align-items-center">
                        <span class="mb-0 ml-auto">Berikut ini adalah daftar template dokumen pengadaan di Poliwangi</span>
                    </div>
                    
                    {{-- <h5> Berikut ini daftar template dokumen pengadaan</h5> --}}
                    {{-- <div class="lead">
                        Manage your template documents here.
                    </div> --}}

                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th width="1%">ID</th>
                                <th  width="25%">Nama Dokumen</th>
                                <th  width="10%" class="text-center">File</th>
                                <th  class="text-center">Deskripsi</th>
                                <th  width="10%" class="text-center">Action</th>
                            </tr>
                            <tbody>
                                @foreach ($documents as $dokumen)
                                    <tr>
                                        <td>{{ $dokumen->id }}</td>
                                        <td>{{ $dokumen->nama_dokumen }}</td>
                                        <td class="text-center"><a href="{{ url('/admin/dokumen/show/' . $dokumen->id) }}" title="Lihat Dokumen"
                                            class="btn icon icon-left btn-secondary btn-sm"><i
                                                class="fa fa-eye"></i> Lihat</a></td>
                                        <td>{{ $dokumen->deskripsi }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('/admin/dokumen/edit/' . $dokumen->id) }}"
                                                class="btn icon-left btn-primary btn-sm"><i class="fa fa-pencil"
                                                    aria-hidden="true"></i> Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="d-flex">
                        {!! $documents->links('pagination::bootstrap-4') !!}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection
