@extends('adminlte::page')

@section('title', 'Daftar Perencanaan')

@section('content_header')
    <h1 class="m-0 text-dark text-center"></h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <h4 class="text-center">Daftar Perencanaan</h4>
                        </div>
                        <div class="card-body">
                            <a href="{{ url('/perencanaan/create') }}" class="btn btn-success btn-sm" title="Tambah Perencanaan">
                                <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                            </a>

                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Perencanaan</th>
                                            <th class="text-center">Kode</th>
                                            <th class="text-center">Sumber</th>
                                            <th class="text-center">Tahun</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($perencanaans as $perencanaan)
                                            <tr>
                                                <td class="text-left">{{ $perencanaan->nama }}</td>
                                                <td class="text-center">{{ $perencanaan->kode }}</td>
                                                <td class="text-center">{{ $perencanaan->sumber }}</td>
                                                <td class="text-center">{{ $perencanaan->tahun }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button type="button" title="Detail"
                                                            class="btn btn-info btn-sm mr-1" data-toggle="modal"
                                                            data-target="#perencanaanModal" data-id="{{ $perencanaan->id }}"
                                                            data-nama="{{ $perencanaan->nama }}"
                                                            data-kode="{{ $perencanaan->kode }}"
                                                            data-sumber="{{ $perencanaan->sumber }}"
                                                            data-revisi="{{ $perencanaan->revisi }}"
                                                            data-tahun="{{ $perencanaan->tahun }}">
                                                            <i class="fas fa-eye" aria-hidden="true"></i>
                                                        </button>

                                                        <button
                                                            onclick="window.location.href='{{ url('/perencanaan/edit/' . $perencanaan->id) }}'"
                                                            title="Edit" class="btn btn-warning btn-sm mr-1">
                                                            <i class="fas fa-pencil" aria-hidden="true"></i>
                                                        </button>

                                                        <form
                                                            action="{{ url('/perencanaan/destroy/' . $perencanaan->id) }}"
                                                            method="POST" accept-charset="UTF-8" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" title="Hapus"
                                                                class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus perencanaan ini?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
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
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="perencanaanModal" tabindex="-1" aria-labelledby="perencanaanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="perencanaanModalLabel">Detail Perencanaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless">
                        <tr>
                            <th>Nama</th>
                            <td id="detailNama"></td>
                        </tr>
                        <tr>
                            <th>Kode</th>
                            <td id="detailKode"></td>
                        </tr>
                        <tr>
                            <th>Sumber</th>
                            <td id="detailSumber"></td>
                        </tr>
                        <tr>
                            <th>Revisi</th>
                            <td id="detailRevisi"></td>
                        </tr>
                        <tr>
                            <th>Tahun</th>
                            <td id="detailTahun"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-2.1.3/datatables.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .modal-custom-size {
            max-width: 80%;
        }

        .modal-body th,
        .modal-body td {
            padding: 8px 10px;
        }

        .modal-body th {
            text-align: right;
            width: 150px;
            /* Sesuaikan lebar sesuai kebutuhan */
            padding-right: 10px;
            /* Tambahkan padding untuk jarak antara th dan td */
        }

        .modal-body th::after {
            content: ":";
            margin-left: 5px;
        }

        .modal-body td {
            text-align: left;
        }

        .modal-body .detail-row {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .modal-body .detail-label {
            min-width: 150px;
            font-weight: bold;
        }

        .modal-body .detail-value {
            flex-grow: 1;
        }
    </style>
@stop

@section('js')
    {{-- JS --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-2.1.3/datatables.min.js"></script>
    <script>
        $('#perencanaanModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var nama = button.data('nama');
            var kode = button.data('kode');
            var sumber = button.data('sumber');
            var revisi = button.data('revisi');
            var tahun = button.data('tahun');

            var modal = $(this);
            modal.find('#detailNama').text(nama);
            modal.find('#detailKode').text(kode);
            modal.find('#detailSumber').text(sumber);
            modal.find('#detailRevisi').text(revisi);
            modal.find('#detailTahun').text(tahun);
        });
    </script>
    <script>
        let table = new DataTable('#myTable');
    </script>
@stop
