@extends('adminlte::page')

@section('title', 'Daftar Perencanaan')

@section('content_header')
    <h1 class="m-0 text-dark text-center">Daftar Perencanaan</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('/perencanaan/create') }}" class="btn btn-success btn-sm" title="Tambah Perencanaan">
                            <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                        </a>

                        <form method="GET" action="{{ url('perencanaan/daftarperencanaan') }}" accept-charset="UTF-8"
                            class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Cari..."
                                    value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br>
                        <br>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>Perencanaan</th>
                                        <th>Kode</th>
                                        <th>Sumber</th>
                                        <th>Tahun</th>
                                        <th colspan="3" >Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($perencanaans as $perencanaan)
                                        <tr class="text-center">
                                            <td>{{ $perencanaan->nama }}</td>
                                            <td>{{ $perencanaan->kode }}</td>
                                            <td>{{ $perencanaan->sumber }}</td>
                                            <td>{{ $perencanaan->tahun }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button type="button" title="Detail" class="btn btn-info btn-sm mr-1" data-toggle="modal"
                                                        data-target="#perencanaanModal" data-id="{{ $perencanaan->id }}"
                                                        data-nama="{{ $perencanaan->nama }}"
                                                        data-kode="{{ $perencanaan->kode }}"
                                                        data-sumber="{{ $perencanaan->sumber }}"
                                                        data-pagu="{{ $perencanaan->pagu }}"
                                                        data-revisi="{{ $perencanaan->revisi }}"
                                                        data-tahun="{{ $perencanaan->tahun }}">
                                                        <i class="fas fa-eye" aria-hidden="true"></i>
                                                    </button>

                                                    <button
                                                        onclick="window.location.href='{{ url('/perencanaan/edit/' . $perencanaan->id) }}'"
                                                        title="Edit" class="btn btn-warning btn-sm mr-1">
                                                        <i class="fas fa-pencil" aria-hidden="true"></i>
                                                    </button>

                                                    <form action="{{ url('/perencanaan/destroy/' . $perencanaan->id) }}"
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
                            <div class="d-flex justify-content-center">
                                {!! $perencanaans->links('pagination::bootstrap-4') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="perencanaanModal" tabindex="-1" aria-labelledby="perencanaanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="perencanaanModalLabel">Detail Akun Belanja</h5>
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
                            <th>Pagu</th>
                            <td id="detailPagu"></td>
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
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('#perencanaanModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var nama = button.data('nama');
            var kode = button.data('kode');
            var sumber = button.data('sumber');
            var pagu = button.data('pagu');
            var revisi = button.data('revisi');
            var tahun = button.data('tahun');

            var modal = $(this);
            modal.find('#detailNama').text(nama);
            modal.find('#detailKode').text(kode);
            modal.find('#detailSumber').text(sumber);
            modal.find('#detailPagu').text(pagu);
            modal.find('#detailRevisi').text(revisi);
            modal.find('#detailTahun').text(tahun);
        });
    </script>
@stop