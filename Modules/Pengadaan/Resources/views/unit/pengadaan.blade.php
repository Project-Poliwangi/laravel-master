@extends('adminlte::page')

@section('title', 'Daftar Pengadaan')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="text-center">Daftar Pengadaan</h4>
                </div>
                <div class="card-body" style="font-size: 14px;">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped table-bordered">
                            <thead>
                                <tr class="text-center bg-dark">
                                    <th class="text-center">No</th> <!-- Kolom untuk nomor urut -->
                                    <th class="text-left">Kegiatan</th>
                                    <th class="text-center">Pagu (Rp.)</th>
                                    <th class="text-center">Sumber</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th><input type="text" placeholder="Kegiatan" class="form-control"></th>
                                    <th><input id="paguSearch" type="text" placeholder="Pagu"
                                            class="form-control text-center">
                                    </th>
                                    <th>
                                        <input type="text" placeholder="Sumber" class="form-control text-center"
                                            id="sumber-search">
                                    </th>
                                    <th><select id="status-filter" class="form-control">
                                            <option value="">Semua Status</option>
                                            <option value="Belum dalam periode">Belum dalam periode</option>
                                            @foreach ($status as $statuses)
                                                <option value="{{ $statuses }}">{{ $statuses->nama_status }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subPerencanaan as $unit)
                                    @if ($unit->pengadaan)
                                        @php
                                            $unit->pengadaan->checkAndUpdateStatus();
                                        @endphp
                                    @endif
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td> <!-- Nomor urut -->
                                        <td class="text-left">{{ $unit->kegiatan }}</td>
                                        <td class="text-right" data-value="{{ $unit->pagu }}">
                                            {{ number_format($unit->pagu, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ $unit->perencanaan->sumber }}</td>
                                        <td class="text-center">
                                            @if ($unit->pengadaan && $unit->pengadaan->status)
                                                @php
                                                    $status = $unit->pengadaan->status->nama_status;
                                                    $statusClass = match ($status) {
                                                        'Pemenuhan Dokumen' => 'badge-danger',
                                                        'Pemilihan Penyedia' => 'badge-primary',
                                                        'Kontrak' => 'badge-warning',
                                                        'Serah Terima' => 'badge-success',
                                                        default => 'badge-default',
                                                    };
                                                @endphp
                                                <span class="badge {{ $statusClass }}">{{ $status }}</span>
                                            @else
                                                <span class="badge badge-default">Belum dalam periode</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <button
                                                    onclick="window.location.href='{{ url('/unit/show/' . $unit->id) }}'"
                                                    title="Detail" class="btn btn-info btn-sm mr-1">
                                                    <i class="fas fa-eye" aria-hidden="true"></i>
                                                </button>
                            
                                                @if (isset($unit->pengadaan) &&
                                                        isset($unit->pengadaan->status) &&
                                                        in_array($unit->pengadaan->status->nama_status, ['Pemenuhan Dokumen']))
                                                    <a href="{{ url('unit/edit/' . $unit->id) }}" title="Edit"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                @endif
                                            </div>
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
@stop

@section('css')
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- DataTables.net-DT -->
    <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-2.1.3/datatables.min.css">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
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

        .table-responsive {
            margin-bottom: 15px;
        }
    </style>
@stop

@section('js')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

    <!-- Bootstrap 4 JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- DataTables.net-DT -->
    <script src="https://cdn.datatables.net/v/dt/dt-2.1.3/datatables.min.js"></script>

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            let table = $('#myTable').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                },
                search: {
                    caseInsensitive: true
                },
                paging: true,
                ordering: true,
                info: true,
                autoWidth: false,
                initComplete: function() {
                    this.api().columns().every(function(index) {
                        let column = this;
                        let input = $(column.header()).find('input'); // Ambil input di thead
                        let select = $(column.header()).find('select'); // Ambil select di thead

                        // Filter untuk input teks di kolom Kegiatan, Pagu, dan Sumber
                        if (input.length) { // Hilangkan pengecualian untuk kolom Pagu
                            input.on('keyup change clear', function() {
                                let val = $(this).val();
                                column.search(val ? val : '', false, false).draw();
                            });
                        }

                        // Filter untuk select dropdown (Status)
                        if (select.length) {
                            select.on('change', function() {
                                let val = $.fn.dataTable.util.escapeRegex($(this)
                                    .val());
                                column.search(val ? val : '', false, false).draw();
                            });
                        }
                    });
                }
            });

            // Filter kolom status yang berada di luar DataTable
            $('#status-filter').on('change', function() {
                let val = $.fn.dataTable.util.escapeRegex($(this).val());
                table.column(4).search(val ? val : '', false, false).draw();
            });
        });
    </script>
@stop
