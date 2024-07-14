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

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ url('admin/dokumen/update/' . $documents->id) }}" accept-charset="UTF-8"
                        class="form-horizontal" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="nama_dokumen" class="col-md-4 col-form-label text-md-right">{{ __('Nama Dokumen') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" disabled name="nama_dokumen" value="{{ isset($documents->nama_dokumen) ? $documents->nama_dokumen : old('nama_dokumen') }}">
                                @if ($errors->has('nama_dokumen'))
                                    <span class="text-danger">{{ $errors->first('nama_dokumen') }}</span>
                                @endif
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('File') }}</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control-file" name="file">
                                @if (isset($documents->file))
                                    <p>Dokumen sudah ada</p>
                                    <input type="hidden" name="existing_file" value="{{ $documents->file }}">
                                @endif
                                @if ($errors->has('file'))
                                    <span class="text-danger">{{ $errors->first('file') }}</span>
                                @endif
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Deskripsi') }}</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="description" id="description" rows="4">{{ isset($documents->description) ? $documents->description : old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
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

                        <!-- Basic Horizontal form layout section start -->
                        {{-- <section id="basic-horizontal-layouts">
                            <div class="row match-height">
                                <div class="col-md-12 col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Edit Template Dokumen Pengadaan</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="nama_dokumen" class="control-label">Nama
                                                                Dokumen</label>
                                                        </div>
                                                        <div
                                                            class="col-md-8 form-group {{ $errors->has('nama_dokumen') ? 'has-error' : '' }}">
                                                            <input class="form-control" name="nama_dokumen" type="text"
                                                                id="nama_dokumen"
                                                                value="{{ isset($documents->nama_dokumen) ? $documents->nama_dokumen : old('nama_dokumen') }}"
                                                                disabled>
                                                            {!! $errors->first('nama_dokumen', '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="file" class="control-label">File</label>
                                                        </div>
                                                        <div
                                                            class="col-md-8 form-group {{ $errors->has('file') ? 'has-error' : '' }}">
                                                            <!-- Basic file uploader -->
                                                            <input type="file" name="file" class="basic-filepond">
                                                            @if (isset($documents->file))
                                                                <p>Dokumen sudah ada : <a
                                                                        href="{{ asset('dokumen/' . $documents->file) }}"
                                                                        target="_blank">Lihat Dokumen</a></p>
                                                                <input type="hidden" name="existing_file"
                                                                    value="{{ $documents->file }}">
                                                            @endif
                                                            @if ($errors->has('file'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('file') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="description" class="control-label">Deskripsi</label>
                                                        </div>
                                                        <div
                                                            class="col-md-8 form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                                            <input class="form-control" name="description" type="text"
                                                                id="description"
                                                                value="{{ isset($documents->description) ? $documents->description : old('description') }}">
                                                            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                        <div class="col-sm-12 d-flex justify-content-end">
                                                            <button type="button" class="btn btn-warning"
                                                                onclick="history.back();">
                                                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                                                            </button>&nbsp;
                                                            <button type="submit" class="btn btn-success">
                                                                Simpan
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section> --}}
                        <!-- // Basic Horizontal form layout section end -->

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
