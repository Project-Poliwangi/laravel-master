@extends('adminlte::page')
@section('title', 'Tambah Permohonan')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-12 order-md-1 order-last">
                <h3>Pengajuan Permohonan</h3>
                <p class="text-subtitle text-muted">Formulir untuk menambahkan pengajuan permohonan</p>

                @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ url('/pengadaan/unit') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('pengadaan::unit.form', ['formMode' => 'create'])

                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
