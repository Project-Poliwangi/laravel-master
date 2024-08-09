@extends('adminlte::page')
@section('title', 'Tambah Pengadaan')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-12 order-md-1 order-last">
                    <h3>Perencanaan Pengadaan</h3>
                    <p class="text-subtitle text-muted">Formulir untuk menambahkan pengadaan</p>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ url('/ppk/store') }}" accept-charset="UTF-8" class="form-horizontal"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('pengadaan::ppk.form', ['formMode' => $formMode])

                        {{-- <div class="col-sm-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-warning" onclick="history.back();">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                            </button>&nbsp;
                            <button type="submit" class="btn btn-success">
                                {{ $formMode === 'create' ? 'Simpan' : 'Edit' }}
                            </button>
                        </div>
                        <br> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
