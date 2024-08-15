@extends('adminlte::page')
@section('title', 'Detail Pengadaan')

@section('content')
    <br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center border-bottom bg-dark">
                    <span>Detail Pengadaan</span>
                    <a href="{{ url('/unit/daftarpengadaan') }}" title="Back"
                        class="btn btn-primary btn-sm rounded-pill shadow-sm" style="margin-left:auto;">
                        <i class="fa fa-arrow-left me-2" aria-hidden="true"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="tableDetail">
                            <tbody>
                                <!-- Konten detail -->
                                <tr>
                                    <th class="bg-light">Kode - Perencanaan</th>
                                    <td>{{ $subPerencanaan->perencanaan->kode }} - {{ $subPerencanaan->perencanaan->nama }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Nama Unit</th>
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
                                    <th class="bg-light">Kegiatan</th>
                                    <td>{{ $subPerencanaan->kegiatan }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Metode Pengadaan</th>
                                    <td>
                                        @if ($subPerencanaan->metodePengadaan)
                                            {{ $subPerencanaan->metodePengadaan->nama_metode }}
                                        @else
                                            <span class="text-muted">Belum ditetapkan</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Jenis Pengadaan</th>
                                    <td>
                                        @if ($subPerencanaan->jenisPengadaan)
                                            {{ $subPerencanaan->jenisPengadaan->nama_jenis }}
                                        @else
                                            <span class="text-muted">Belum ditetapkan</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Volume</th>
                                    <td>{{ $subPerencanaan->volume }} {{ $subPerencanaan->satuan }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Harga Satuan</th>
                                    <td>Rp. {{ number_format($subPerencanaan->harga_satuan, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Total Pagu</th>
                                    <td>Rp. {{ number_format($subPerencanaan->pagu, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Output</th>
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
                                    <th class="bg-light">Rencana Mulai</th>
                                    <td>{{ $rencanaMulai }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Rencana Bayar</th>
                                    <td>{{ $rencanaBayar }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Penanggung Jawab (PIC)</th>
                                    <td>
                                        @if ($subPerencanaan->pic)
                                            {{ $subPerencanaan->pic->nama }}
                                        @else
                                            <span class="text-muted">Belum ditetapkan</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Pejabat Pembuat Komitmen (PPK)</th>
                                    <td>
                                        @if ($subPerencanaan->ppk)
                                            {{ $subPerencanaan->ppk->nama }}
                                        @else
                                            <span class="text-muted">Belum ditetapkan</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Pejabat Pengadaan (PP)</th>
                                    <td>
                                        @if ($subPerencanaan->pp)
                                            {{ $subPerencanaan->pp->nama }}
                                        @else
                                            <span class="text-muted">Belum ditetapkan</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Catatan</th>
                                    <td>
                                        @if (
                                            $subPerencanaan->pengadaan &&
                                                $subPerencanaan->pengadaan->status &&
                                                $subPerencanaan->pengadaan->status->nama_status == 'Pemenuhan Dokumen')
                                            <div class="alert alert-info mb-0">
                                                {{ $subPerencanaan->pengadaan->catatan ?? 'Belum ada catatan' }}
                                            </div>
                                        @else
                                            <div class="alert alert-secondary mb-0">
                                                Belum ada catatan
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        {{-- Tracking --}}
                        <div class="status-timeline">
                            <div class="status-header text-center bg-dark">
                                <h5>Status Pengadaan</h5>
                            </div>
                            <div class="timeline">
                                <!-- Status 0: Belum Dalam Periode -->
                                <div class="timeline-item">
                                    <div class="timeline-icon @if ($status == 0) active @endif">
                                        <i class="fa fa-calendar-times"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h6 class="timeline-title">Belum Dalam Periode</h6>
                                        {{-- <span class="timeline-date">
                                            {{ isset($subPerencanaan->pengadaan->tanggal_status_0) ? date('d M Y', strtotime($subPerencanaan->pengadaan->tanggal_status_0)) : '-' }}
                                        </span> --}}
                                    </div>
                                </div>
                                <!-- Status 1: Pemenuhan Dokumen -->
                                <div class="timeline-item">
                                    <div class="timeline-icon @if ($status == 1) active @endif">
                                        <i class="fa fa-file-alt"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h6 class="timeline-title">Pemenuhan Dokumen</h6>
                                        <span class="timeline-date">
                                            {{ isset($subPerencanaan->pengadaan->tanggal_status_1) ? date('d M Y', strtotime($subPerencanaan->pengadaan->tanggal_status_1)) : '-' }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Status 2: Pemilihan Penyedia -->
                                <div class="timeline-item">
                                    <div class="timeline-icon @if ($status == 2) active @endif">
                                        <i class="fa fa-check-circle"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h6 class="timeline-title">Pemilihan Penyedia</h6>
                                        <span class="timeline-date">
                                            {{ isset($subPerencanaan->pengadaan->tanggal_status_2) ? date('d M Y', strtotime($subPerencanaan->pengadaan->tanggal_status_2)) : '-' }}
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Status 3: Kontrak -->
                                <div class="timeline-item">
                                    <div class="timeline-icon @if ($status == 3) active @endif">
                                        <i class="fa fa-handshake"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h6 class="timeline-title">Kontrak</h6>
                                        <span class="timeline-date">
                                            {{ isset($subPerencanaan->pengadaan->tanggal_status_3) ? date('d M Y', strtotime($subPerencanaan->pengadaan->tanggal_status_3)) : '-' }}
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Status 4: Serah Terima -->
                                <div class="timeline-item">
                                    <div class="timeline-icon @if ($status == 4) active @endif">
                                        <i class="fa fa-archive"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h6 class="timeline-title">Serah Terima</h6>
                                        <span class="timeline-date">
                                            {{ isset($subPerencanaan->pengadaan->tanggal_status_4) ? date('d M Y', strtotime($subPerencanaan->pengadaan->tanggal_status_4)) : '-' }}
                                        </span>
                                    </div>
                                </div>   
                            </div>

                        </div>
                        <hr>
                        <div class="card-header text-center bg-dark">Dokumen-Dokumen Pengadaan</div>
                        <table class="table table-bordered" id="tableDetail">
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
                                    @if ($subPerencanaan->pengadaan && $subPerencanaan->pengadaan->dokumen_kontrak)
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
                                    @if ($subPerencanaan->pengadaan && $subPerencanaan->pengadaan->dokumen_serah_terima)
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
                        </tbody>
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

        /* Styling untuk Timeline */
        .status-timeline {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .status-header {
            margin-bottom: 20px;
        }

        .status-header h5 {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin: 0;
            padding: 10px;
            color: #fff;
            border-radius: 4px;
            letter-spacing: 1px;
        }

        .timeline {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            overflow-x: hidden;
        }

        .timeline-item {
            text-align: center;
            flex-basis: 18%;
            /* Menyesuaikan lebar tiap item */
        }

        .timeline-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #f0f0f0;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #6c757d;
        }

        .timeline-icon.active {
            background-color: #007bff;
            color: white;
        }

        .timeline-content {
            margin-top: 10px;
        }

        .timeline-title {
            margin: 5px 0;
            font-weight: bold;
        }

        .timeline-date {
            font-size: 12px;
            color: #6c757d;
        }
    </style>
@stop
