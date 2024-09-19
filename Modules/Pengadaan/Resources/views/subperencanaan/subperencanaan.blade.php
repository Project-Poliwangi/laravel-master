@extends('adminlte::page')

@section('title', 'Daftar Sub Perencanaan')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h5 class="text-center">Daftar Sub Perencanaan</h5>
                    </div>
                    <div class="card-body" style="font-size: 13px;">
                        <a href="{{ url('/subperencanaan/create') }}" class="btn btn-success btn-sm"
                            title="Tambah SubPerencanaan">
                            <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                        </a>

                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr class="text-center bg-dark">
                                        <th>Perencanaan</th>
                                        <th>Kegiatan</th>
                                        <th class="text-center">Jenis Pengadaan</th>
                                        <th class="text-center">Unit</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subPerencanaan as $sub)
                                        <tr>
                                            <td id="nama_perencanaan_{{ $sub->id }}">
                                                {{ $sub->perencanaan->nama }}
                                            </td>
                                            <td id="kegiatan_{{ $sub->id }}">{{ $sub->kegiatan }}
                                            </td>
                                            <td class="text-center" id="jenis_pengadaan_{{ $sub->id }}">
                                                {{ $sub->jenisPengadaan->nama_jenis }}</td>
                                            <td class="text-center" id="unit_{{ $sub->unit }}">{{ $sub->unit->nama }}
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <button onclick="window.location.href='{{ url('/subperencanaan/show/' . $sub->id) }}'"
                                                        title="Detail" class="btn btn-info btn-sm mr-1">
                                                        <i class="fas fa-eye" aria-hidden="true"></i>
                                                    </button>

                                                    <button
                                                        onclick="window.location.href='{{ url('/subperencanaan/edit/' . $sub->id) }}'"
                                                        title="Edit" class="btn btn-warning btn-sm mr-1">
                                                        <i class="fas fa-pencil" aria-hidden="true"></i>
                                                    </button>

                                                    <form action="{{ url('/subperencanaan/destroy/' . $sub->id) }}"
                                                        method="POST" accept-charset="UTF-8" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="Hapus" class="btn btn-danger btn-sm">
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
        document.querySelectorAll('form button[type="submit"]').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Cegah pengiriman form langsung
                console.log('Tombol hapus diklik'); // Debugging
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.closest('form').submit();
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            let table = new DataTable('#myTable', {
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
            });
        });
    </script>

@stop
