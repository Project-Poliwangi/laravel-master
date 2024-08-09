@extends('adminlte::page')
@section('title', 'Tambah Perencanaan')
@section('content_header')
    <h1 class="m-0 text-dark text-center">Tambah Akun Belanja</h1>
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 order-md-1 order-last">

                <form method="POST" action="{{ url('/perencanaan/store') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    @include ('pengadaan::perencanaan.form', ['formMode' => $formMode])
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@stop