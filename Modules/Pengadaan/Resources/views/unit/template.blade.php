@extends('adminlte::page')
@section('title', 'Template Dokumen')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h1>Template Dokumen</h1>
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
                            <th>File</th>
                        </tr>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Kerangka Acuan Kerja (KAK)</td>
                                <td>
                                    <a href="#" class="btn icon icon-left btn-secondary btn-sm"><i
                                            class="bi bi-eye"></i> Download</a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Harga Perkiraan Sendiri (HPS)</td>
                                <td>
                                    <a href="#" class="btn icon icon-left btn-secondary btn-sm"><i
                                            class="bi bi-eye"></i> Download</a>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Stock Opname</td>
                                <td>
                                    <a href="#" class="btn icon icon-left btn-secondary btn-sm"><i
                                            class="bi bi-eye"></i> Download</a>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Surat Ijin Impor</td>
                                <td>
                                    <a href="#" class="btn icon icon-left btn-secondary btn-sm"><i
                                            class="bi bi-eye"></i> Download</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="d-flex">
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
