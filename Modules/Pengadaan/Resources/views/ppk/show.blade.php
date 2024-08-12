@extends('adminlte::page')

@section('title', 'Detail Pengadaan')

@section('content')
    <br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center border-bottom bg-dark">
                    <span>Detail Pengadaan</span>
                    <a href="{{ url('/ppk/daftarpengadaan') }}" title="Back"
                        class="btn btn-primary btn-sm rounded-pill shadow-sm" style="margin-left:auto;">
                        <i class="fa fa-arrow-left me-2" aria-hidden="true"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="tableDetail">
                            <tr>
                                <th class="bg-light" style="width: 30%; vertical-align: middle;">Kode</th>
                                <td>{{ $subPerencanaan->perencanaan->kode }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light" style="width: 30%; vertical-align: middle;">Perencanaan</th>
                                <td>{{ $subPerencanaan->perencanaan->nama }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light" style="width: 30%; vertical-align: middle;">Nama Unit</th>
                                <td>{{ $subPerencanaan->unit->nama }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light" style="width: 30%; vertical-align: middle;">Tahun Anggaran</th>
                                <td>{{ $subPerencanaan->perencanaan->tahun }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light" style="width: 30%; vertical-align: middle;">Sumber</th>
                                <td>{{ $subPerencanaan->perencanaan->sumber }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light" style="width: 30%; vertical-align: middle;">Kegiatan</th>
                                <td>{{ $subPerencanaan->kegiatan }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light" style="width: 30%; vertical-align: middle;">Metode Pengadaan</th>
                                <td>
                                    @if ($subPerencanaan->metodePengadaan)
                                        {{ $subPerencanaan->metodePengadaan->nama_metode }}
                                    @else
                                        <span class="text-muted">Belum ditetapkan</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light" style="width: 30%; vertical-align: middle;">Jenis Pengadaan</th>
                                <td>
                                    @if ($subPerencanaan->jenisPengadaan)
                                        {{ $subPerencanaan->jenisPengadaan->nama_jenis }}
                                    @else
                                        <span class="text-muted">Belum ditetapkan</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light" style="width: 30%; vertical-align: middle;">Volume</th>
                                <td>{{ $subPerencanaan->volume }} {{ $subPerencanaan->satuan }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light" style="width: 30%; vertical-align: middle;">Harga Satuan</th>
                                <td>Rp. {{ number_format($subPerencanaan->harga_satuan, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light" style="width: 30%; vertical-align: middle;">Total Pagu</th>
                                <td>Rp. {{ number_format($subPerencanaan->pagu, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light" style="width: 30%; vertical-align: middle;">Output</th>
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
                                <th class="bg-light" style="width: 30%; vertical-align: middle;">Rencana Mulai</th>
                                <td>{{ $rencanaMulai }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light" style="width: 30%; vertical-align: middle;">Rencana Bayar</th>
                                <td>{{ $rencanaBayar }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light" style="width: 30%; vertical-align: middle;">Penanggung Jawab (PIC)</th>
                                <td>
                                    @if ($subPerencanaan->pic)
                                        {{ $subPerencanaan->pic->nama }}
                                    @else
                                        <span class="text-muted">Belum ditetapkan</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light" style="width: 30%; vertical-align: middle;">Pejabat Pengadaan (PP)</th>
                                <td>@if ($subPerencanaan->pp)
                                    {{ $subPerencanaan->pp->nama }}
                                @else
                                    <span class="text-muted">Belum ditetapkan</span>
                                @endif</td>
                            </tr>
                        </table>

                        <hr>
                        <div class="card-header text-center bg-dark">Dokumen-Dokumen Pengadaan</div>
                        <table class="table" id="tableDetail">
                            <tr>
                                <th style="width: 30%; vertical-align: middle;">
                                    <i class="fa fa-file-alt text-primary"></i> Kerangka Acuan Kerja (KAK)
                                </th>
                                <td style="vertical-align: middle;">
                                    @if ($subPerencanaan->pengadaan && $subPerencanaan->pengadaan->dokumen_kak)
                                        <a href="{{ asset('storage/' . $subPerencanaan->pengadaan->dokumen_kak) }}"
                                            target="_blank" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-download"></i> Unduh Dokumen
                                        </a>
                                    @else
                                        <span class="text-muted"><i class="fa fa-exclamation-circle"></i> Dokumen
                                            belum
                                            tersedia</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 30%; vertical-align: middle;">
                                    <i class="fa fa-file-alt text-primary"></i> Harga Perkiraan Sendiri (HPS)
                                </th>
                                <td style="vertical-align: middle;">
                                    @if ($subPerencanaan->pengadaan && $subPerencanaan->pengadaan->dokumen_hps)
                                        <a href="{{ asset('storage/' . $subPerencanaan->pengadaan->dokumen_hps) }}"
                                            target="_blank" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-download"></i> Unduh Dokumen
                                        </a>
                                    @else
                                        <span class="text-muted"><i class="fa fa-exclamation-circle"></i> Dokumen
                                            belum
                                            tersedia</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 30%; vertical-align: middle;">
                                    <i class="fa fa-file-alt text-primary"></i> Stock Opname
                                </th>
                                <td style="vertical-align: middle;">
                                    @if ($subPerencanaan->pengadaan && $subPerencanaan->pengadaan->dokumen_stock_opname)
                                        <a href="{{ asset('storage/' . $subPerencanaan->pengadaan->dokumen_stock_opname) }}"
                                            target="_blank" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-download"></i> Unduh Dokumen
                                        </a>
                                    @else
                                        <span class="text-muted"><i class="fa fa-exclamation-circle"></i> Dokumen
                                            belum
                                            tersedia</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 30%; vertical-align: middle;">
                                    <i class="fa fa-file-alt text-primary"></i> Surat Ijin Impor
                                </th>
                                <td style="vertical-align: middle;">
                                    @if ($subPerencanaan->pengadaan && $subPerencanaan->pengadaan->dokumen_surat_ijin_impor)
                                        <a href="{{ asset('storage/' . $subPerencanaan->pengadaan->dokumen_surat_ijin_impor) }}"
                                            target="_blank" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-download"></i> Unduh Dokumen
                                        </a>
                                    @else
                                        <span class="text-muted"><i class="fa fa-exclamation-circle"></i> Dokumen
                                            belum
                                            tersedia</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 30%; vertical-align: middle;">
                                    <i class="fa fa-file-alt text-primary"></i> Dokumen Pemilihan Penyedia
                                </th>
                                <td style="vertical-align: middle;">
                                    @if ($subPerencanaan->pengadaan && $subPerencanaan->pengadaan->dokumen_pemilihan_penyedia)
                                        <a href="{{ asset('storage/' . $subPerencanaan->pengadaan->dokumen_pemilihan_penyedia) }}"
                                            target="_blank" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-download"></i> Unduh Dokumen
                                        </a>
                                    @else
                                        <span class="text-muted"><i class="fa fa-exclamation-circle"></i> Dokumen
                                            belum
                                            tersedia</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 30%; vertical-align: middle;">
                                    <i class="fa fa-file-alt text-primary"></i> Dokumen Kontrak
                                </th>
                                <td style="vertical-align: middle;">
                                    @if (
                                        $subPerencanaan->status &&
                                            !in_array($subPerencanaan->status->nama_status, ['Kontrak', 'Serah Terima']) &&
                                            $subPerencanaan->pengadaan &&
                                            $subPerencanaan->pengadaan->dokumen_kontrak)
                                        <a href="{{ asset('storage/' . $subPerencanaan->pengadaan->dokumen_kontrak) }}"
                                            target="_blank" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-download"></i> Unduh Dokumen
                                        </a>
                                    @else
                                        <span class="text-muted"><i class="fa fa-exclamation-circle"></i> Dokumen
                                            belum
                                            tersedia</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 30%; vertical-align: middle;">
                                    <i class="fa fa-file-alt text-primary"></i> Dokumen Serah Terima
                                </th>
                                <td style="vertical-align: middle;">
                                    @if (
                                        $subPerencanaan->status &&
                                            !in_array($subPerencanaan->status->nama_status, ['Serah Terima']) &&
                                            $subPerencanaan->pengadaan &&
                                            $subPerencanaan->pengadaan->dokumen_serah_terima)
                                        <a href="{{ asset('storage/' . $subPerencanaan->pengadaan->dokumen_serah_terima) }}"
                                            target="_blank" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-download"></i> Unduh Dokumen
                                        </a>
                                    @else
                                        <span class="text-muted"><i class="fa fa-exclamation-circle"></i> Dokumen
                                            belum
                                            tersedia</span>
                                    @endif
                                </td>
                            </tr>
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
        body {
            font-size: 14px;
            line-height: 1.6;
        }

        h4,
        .h4 {
            font-weight: 700;
        }

        th {
            font-weight: 600;
        }

        .card-header.bg-dark {
            background-color: #343a40;
            /* Warna lebih lembut untuk bg-dark */
            color: #ffc107;
            /* Teks warna kuning untuk kontras */
        }

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
            text-align: left;
            width: 350px;
            padding-right: 10px;
        }

        /* #tableDetail th::after {
                                content: ":";
                                margin-left: 20px;
                            } */

        #tableDetail td {
            text-align: left;
        }

        #tableDetail td:nth-of-type(2) {
            text-align: left;
        }
    </style>
@stop
