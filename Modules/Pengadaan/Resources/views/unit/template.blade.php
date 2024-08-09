@extends('adminlte::page')
@section('title', 'Template Dokumen')
@section('content_header')
    <h1 class="m-0 text-dark">Template Dokumen Pengadaan</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="lead">
                        Tabel berisi file template dokumen permohonan pengadaan.
                    </div>

                    <div class="mt-2">
                        @include('layouts.partials.messages')
                    </div>

                    <table class="table table-bordered">
                        <tr>
                            <th width="1%">ID</th>
                            <th>Nama</th>
                            <th class="text-center">Deskripsi</th>
                            <th class="text-center">File</th>
                        </tr>
                        <tbody>
                            @foreach ($templateDokumens as $templateDokumen)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $templateDokumen->nama_dokumen }}</td>
                                    <td>{{ $templateDokumen->deskripsi }}</td>
                                    <td>
                                        <a href="{{ asset('storage/dokumen_template/' . $templateDokumen->file) }}"
                                            class="btn btn-secondary btn-sm" download>
                                            Download
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
