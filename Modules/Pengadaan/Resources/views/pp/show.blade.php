@extends('adminlte::page')
@section('title', 'Detail Pengadaan')
@section('content_header')
    <h1 class="m-0 text-dark">
    </h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <a href="{{ url('/pp/daftarpengadaan') }}" title="Back">
                        <button class="btn btn-warning btn-sm">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                        </button>
                    </a>
                    <span class="mb-0 ml-auto">Detail Pengadaan</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <!-- Konten detail -->
                                <table class="table table-borderless" id="tableDetail">
                                    <tr>
                                        <th>Akun Belanja</th>
                                        <td>{{ $subPerencanaan->perencanaans->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Unit</th>
                                        <td>{{ $subPerencanaan->unit->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kegiatan</th>
                                        <td>{{ $subPerencanaan->kegiatan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Metode Pengadaan</th>
                                        <td>{{ $subPerencanaan->metodepengadaans ? $subPerencanaan->metodepengadaans->nama_metode : '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Pengadaan</th>
                                        <td>{{ $subPerencanaan->jenispengadaans ? $subPerencanaan->jenispengadaans->nama_jenis : '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Satuan</th>
                                        <td>{{ $subPerencanaan->satuan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Volume</th>
                                        <td>{{ $subPerencanaan->volume }}</td>
                                    </tr>
                                    <tr>
                                        <th>Harga Satuan</th>
                                        <td>Rp.{{ $subPerencanaan->harga_satuan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Output</th>
                                        <td>{{ $subPerencanaan->output }}</td>
                                    </tr>
                                    <tr>
                                        <th>Rencana Mulai</th>
                                        <td>{{ $subPerencanaan->rencana_mulai }}</td>
                                    </tr>
                                    <tr>
                                        <th>Rencana Bayar</th>
                                        <td>{{ $subPerencanaan->rencana_bayar }}</td>
                                    </tr>
                                    <tr>
                                        <th>PIC</th>
                                        <td>{{ $subPerencanaan->pic ? $subPerencanaan->pic->nama : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pejabat Pembuat Komitemen (PPK)</th>
                                        <td>{{ $subPerencanaan->ppk ? $subPerencanaan->ppk->nama : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pejabat Pengadaan (PP)</th>
                                        <td>{{ $subPerencanaan->pp ? $subPerencanaan->pp->nama : '-' }}</td>
                                    </tr>
                                </table>

                                <hr>
                                <div class="card-header text-center">Dokumen-Dokumen Pengadaan</div>
                                <table class="table table-borderless" id="tableDetail">
                                    <tr>
                                        <th>Kerangka Acuan Kerja (KAK)</th>
                                        <td>
                                            @if ($subPerencanaan->pengadaan && $subPerencanaan->pengadaan->dokumen_kak)
                                                <a href="{{ asset('storage/' . $subPerencanaan->pengadaan->dokumen_kak) }}"
                                                    target="_blank">{{ $subPerencanaan->pengadaan->dokumen_kak }}</a>
                                            @else
                                                <p>Tidak ada dokumen</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Harga Perkiraan Sendiri (HPS)</th>
                                        <td>
                                            @if ($subPerencanaan->pengadaan && $subPerencanaan->pengadaan->dokumen_hps)
                                                <a href="{{ asset('storage/' . $subPerencanaan->pengadaan->dokumen_hps) }}"
                                                    target="_blank">{{ $subPerencanaan->pengadaan->dokumen_hps }}</a>
                                            @else
                                                Tidak ada dokumen
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Stock Opname</th>
                                        <td>
                                            @if ($subPerencanaan->pengadaan && $subPerencanaan->pengadaan->dokumen_stock_opname)
                                                <a href="{{ asset('storage/' . $subPerencanaan->pengadaan->dokumen_stock_opname) }}"
                                                    target="_blank">{{ $subPerencanaan->pengadaan->dokumen_stock_opname }}</a>
                                            @else
                                                <p>Tidak ada dokumen</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Surat Ijin Impor</th>
                                        <td>
                                            @if ($subPerencanaan->pengadaan && $subPerencanaan->pengadaan->dokumen_surat_ijin_impor)
                                                <a href="{{ asset('storage/' . $subPerencanaan->pengadaan->dokumen_surat_ijin_impor) }}"
                                                    target="_blank">{{ $subPerencanaan->pengadaan->dokumen_surat_ijin_impor }}</a>
                                            @else
                                                <p>Tidak ada dokumen</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Dokumen Pemilihan Penyedia</th>
                                        <td>
                                            @if ($subPerencanaan->pengadaan && $subPerencanaan->pengadaan->dokumen_pemilihan_penyedia)
                                                <a href="{{ asset('storage/' . $subPerencanaan->pengadaan->dokumen_pemilihan_penyedia) }}"
                                                    target="_blank">{{ $subPerencanaan->pengadaan->dokumen_pemilihan_penyedia }}</a>
                                            @else
                                                <p>Tidak ada dokumen</p>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        #tableDetail {
            width: 100%;
            border-collapse: collapse;
        }

        #tableDetail th,
        #tableDetail td {
            padding: 12px 15px;
            border: 1px solid #ddd;
        }

        #tableDetail th {
            text-align: right;
            width: 350px;
            padding-right: 10px;
        }

        #tableDetail th::after {
            content: ":";
            margin-left: 20px;
        }

        #tableDetail td {
            text-align: left;
        }

        #tableDetail td:nth-of-type(2) {
            text-align: left;
        }
    </style>
@stop
