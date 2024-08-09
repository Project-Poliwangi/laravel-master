@extends('adminlte::page')
@section('title', 'Edit Dokumen')
@section('content_header')
    <h1 class="m-0 text-dark">Edit Template Dokumen Pengadaan</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    {{-- @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul> 
                    @endif --}}

                    <form method="POST" action="{{ url('admin/dokumen/update/' . $documents->id) }}" accept-charset="UTF-8"
                        class="form-horizontal" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="nama_dokumen"
                                class="col-md-4 col-form-label text-md-right">{{ __('Nama Dokumen') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" disabled name="nama_dokumen"
                                    value="{{ isset($documents->nama_dokumen) ? $documents->nama_dokumen : old('nama_dokumen') }}">
                                @if ($errors->has('nama_dokumen'))
                                    <span class="text-danger">{{ $errors->first('nama_dokumen') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('File') }}</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control-file" name="file"> <small
                                    class="form-text text-muted">*Format pdf,doc,docx,xls,xlsx dengan maksimal ukuran file
                                    10 MB</small>
                                @if (isset($documents->file))
                                    <p>Dokumen sudah ada: <a
                                            href="{{ url('storage/dokumen_template/' . $documents->file) }}"
                                            target="_blank">{{ $documents->file }}</a></p>
                                    <input type="hidden" name="existing_file" value="{{ $documents->file }}">
                                @endif
                                @if ($errors->has('file'))
                                    <span class="text-danger">{{ $errors->first('file') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="deskripsi"
                                class="col-md-4 col-form-label text-md-right">{{ __('Deskripsi') }}</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="4">{{ isset($documents->deskripsi) ? $documents->deskripsi : old('deskripsi') }}</textarea>
                                @if ($errors->has('deskripsi'))
                                    <span class="text-danger">{{ $errors->first('deskripsi') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-warning" onclick="history.back();">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                                </button>&nbsp;
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>

                        <!-- Skrip SweetAlert -->
                        @if (session('success_edit'))
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: "{{ session('success') }}",
                                        showConfirmButton: true,
                                        confirmButtonText: 'OK',
                                        customClass: {
                                            popup: 'swal-wide',
                                            confirmButton: 'btn btn-success'
                                        }
                                    });
                                });
                            </script>
                        @endif
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
