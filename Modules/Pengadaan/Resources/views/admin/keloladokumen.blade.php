@extends('adminlte::page')
@section('title', 'Kelola Dokumen')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header bg-dark">
                        <h5 class="text-center">Template Dokumen Pengadaan</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="mb-0" style="font-size: 1.1rem;">Berikut ini adalah daftar template dokumen pengadaan di Politeknik Negeri Banyuwangi</p>
                            <a href="{{ url('admin/dokumen/create') }}" class="btn btn-success btn-sm" title="Tambah Dokumen">
                                <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                            </a>
                        </div><br>
                                             
                        <table class="table table-bordered">
                            <tr class="bg-dark">
                                <th  class="text-center">No.</th>
                                <th>Nama Dokumen</th>
                                <th class="text-center" style="width: 600px;">Deskripsi</th>
                                <th class="text-center">File</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                            <tbody>
                                @foreach ($documents as $dokumen)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $dokumen->nama_dokumen }}</td>
                                        <td>{{ $dokumen->deskripsi }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('storage/dokumen_template/' . $dokumen->file) }}" 
                                               title="Download Dokumen" 
                                               class="btn icon icon-left btn-secondary btn-sm" 
                                               download="{{ $dokumen->file }}">
                                                <i class="fa fa-download"></i>
                                            </a>
                                        </td>                                        
                                        <td class="text-center">
                                            <!-- Tombol Edit -->
                                            <a href="{{ url('/admin/dokumen/edit/' . $dokumen->id) }}" 
                                               class="btn icon-left btn-warning btn-sm">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        
                                            <!-- Tombol Hapus -->
                                            <form action="{{ url('/admin/dokumen/destroy/' . $dokumen->id) }}"
                                                method="POST" accept-charset="UTF-8" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Hapus" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
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
@stop
