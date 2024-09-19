@extends('adminlte::page')
@section('title', 'Detail Program Pengadaan')

@section('content')
    <br>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-10 order-md-1 order-last">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <a href="{{ url('/subperencanaan/subperencanaan') }}" title="Back">
                        <button class="btn btn-warning btn-sm">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                        </button>
                    </a>
                    <span class="mb-0 ml-auto">Detail {{ $subPerencanaan->kegiatan }}</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tableDetail">
                            <tbody>
                                <tr>
                                    <th>Perencanaan</th>
                                    <td>{{ $subPerencanaan->perencanaan->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Unit/Jurusan/Pusat</th>
                                    <td>{{ $subPerencanaan->unit->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Kegiatan</th>
                                    <td>{{ $subPerencanaan->kegiatan }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Pengadaan</th>
                                    <td>{{ $subPerencanaan->jenisPengadaan ? $subPerencanaan->jenisPengadaan->nama_jenis : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Volume</th>
                                    <td>{{ $subPerencanaan->volume }} {{ $subPerencanaan->satuan }}</td>
                                </tr>
                                <tr>
                                    <th>Harga Satuan</th>
                                    <td>Rp.{{ number_format($subPerencanaan->harga_satuan, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Total Pagu</th>
                                    <td>Rp.{{ number_format($subPerencanaan->pagu, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Output</th>
                                    <td>{{ $subPerencanaan->output }}</td>
                                </tr>
                                @php
                                    // Array bulan dalam bahasa Indonesia
                                    $bulan = [
                                        1 => 'Januari',
                                        2 => 'Februari',
                                        3 => 'Maret',
                                        4 => 'April',
                                        5 => 'Mei',
                                        6 => 'Juni',
                                        7 => 'Juli',
                                        8 => 'Agustus',
                                        9 => 'September',
                                        10 => 'Oktober',
                                        11 => 'November',
                                        12 => 'Desember',
                                    ];

                                    // Mendapatkan bulan dari tanggal
                                    $bulanMulai = $bulan[date('n', strtotime($subPerencanaan->rencana_mulai))];
                                    $bulanBayar = $bulan[date('n', strtotime($subPerencanaan->rencana_bayar))];

                                    // Membentuk tanggal lengkap
                                    $rencanaMulai =
                                        date('d', strtotime($subPerencanaan->rencana_mulai)) .
                                        ' ' .
                                        $bulanMulai .
                                        ' ' .
                                        date('Y', strtotime($subPerencanaan->rencana_mulai));
                                    $rencanaBayar =
                                        date('d', strtotime($subPerencanaan->rencana_bayar)) .
                                        ' ' .
                                        $bulanBayar .
                                        ' ' .
                                        date('Y', strtotime($subPerencanaan->rencana_bayar));
                                @endphp
                                <tr>
                                    <th>Rencana Mulai</th>
                                    <td>{{ $rencanaMulai }}</td>
                                </tr>
                                <tr>
                                    <th>Rencana Bayar</th>
                                    <td>{{ $rencanaBayar }}</td>
                                </tr>
                                <tr>
                                    <th>Pejabat Pembuat Komitmen</th>
                                    <td>{{ $subPerencanaan->ppk ? $subPerencanaan->ppk->nama : '-' }}</td>
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
            text-align: left;
            width: 250px;
            padding-right: 10px;
        }

        /* #tableDetail th::after,
            #tableDocuments th::after {
                content: ":";
                margin-left: 5px;
            } */

        #tableDetail td,
        #tableDocuments td {
            text-align: left;
        }
    </style>
@stop
