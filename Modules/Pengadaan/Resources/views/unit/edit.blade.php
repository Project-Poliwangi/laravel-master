@extends('adminlte::page')
@section('title', 'Edit Formulir')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Formulir Pengadaan</h4>
                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ url('unit/update/' . $subPerencanaan->id) }}" accept-charset="UTF-8"
                        class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @include ('pengadaan::unit.form', [
                            'formMode' => $formMode,
                            'pengadaan' => $pengadaan,
                            'subPerencanaan' => $subPerencanaan,
                        ])

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
