@extends('adminlte::page')
@section('title', 'Detail Program Pengadaan')

@section('content')
<br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <a href="{{ url('/subperencanaan/subperencanaan') }}" title="Back">
                        <button class="btn btn-warning btn-sm">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                        </button>
                    </a>
                    <span class="mb-0 ml-auto">Detail {{ $subperencanaan->kegiatan }}</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless" id="tableDetail">
                            <tbody>
                                <tr>
                                    <th>Akun Belanja</th>
                                    <td>{{ $subperencanaan->perencanaans->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Unit/Jurusan/Pusat</th>
                                    <td>{{ $subperencanaan->unit->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Kegiatan</th>
                                    <td>{{ $subperencanaan->kegiatan }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Pengadaan</th>
                                    <td>{{ $subperencanaan->jenispengadaans ? $subperencanaan->jenispengadaans->nama_jenis : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Satuan</th>
                                    <td>{{ $subperencanaan->satuan }}</td>
                                </tr>
                                <tr>
                                    <th>Volume</th>
                                    <td>{{ $subperencanaan->volume }}</td>
                                </tr>
                                <tr>
                                    <th>Harga Satuan</th>
                                    <td>{{ $subperencanaan->harga_satuan }}</td>
                                </tr>
                                <tr>
                                    <th>Output</th>
                                    <td>{{ $subperencanaan->output }}</td>
                                </tr>
                                <tr>
                                    <th>Rencana Mulai</th>
                                    <td>{{ $subperencanaan->rencana_mulai }}</td>
                                </tr>
                                <tr>
                                    <th>Rencana Bayar</th>
                                    <td>{{ $subperencanaan->rencana_bayar }}</td>
                                </tr>
                                <tr>
                                    <th>Pejabat Pembuat Komitmen</th>
                                    <td>{{ $subperencanaan->ppk ? $subperencanaan->ppk->nama : '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        #tableDetail th,
        #tableDetail td,
        #tableDocuments th,
        #tableDocuments td {
            padding: 8px 10px;
        }

        #tableDetail th,
        #tableDocuments th {
            text-align: right;
            width: 250px;
            padding-right: 10px;
        }

        #tableDetail th::after,
        #tableDocuments th::after {
            content: ":";
            margin-left: 5px;
        }

        #tableDetail td,
        #tableDocuments td {
            text-align: left;
        }
    </style>
@stop
