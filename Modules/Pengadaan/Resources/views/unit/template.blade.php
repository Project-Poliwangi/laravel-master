@extends('adminlte::page')

@section('title', 'Template Dokumen')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-light">
                        <h5 class="text-center font-weight-bold">Template Dokumen Pengadaan</h5>
                    </div>
                    <div class="card-body">
                        <div class="lead text-center mb-4">
                            <p>Tabel berisi file template dokumen permohonan pengadaan</p>
                        </div>

                        <div class="mt-2">
                            @include('layouts.partials.messages')
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-dark text-light">
                                    <th class="text-center">No.</th>
                                    <th>Nama</th>
                                    <th class="text-center" style="width: 500px;">Deskripsi</th>
                                    <th class="text-center">File</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($templateDokumens as $templateDokumen)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $templateDokumen->nama_dokumen }}</td>
                                        <td>{{ $templateDokumen->deskripsi }}</td>
                                        <td class="text-center">
                                            <a href="{{ asset('storage/dokumen_template/' . $templateDokumen->file) }}"
                                                class="btn btn-secondary btn-sm download-btn" download>
                                                <i class="fas fa-download"></i> Download
                                            </a>
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
@endsection

@section('css')
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Handle download link
        document.querySelectorAll('.download-btn').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Cegah pengunduhan langsung
                Swal.fire({
                    title: 'Sukses',
                    text: 'File akan mulai diunduh.',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Batal',
                    showCancelButton: true // Tampilkan tombol Batal
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Lanjutkan unduh setelah menekan OK
                        window.location.href = this.href;
                    }
                });
            });
        });
    </script>
@stop
