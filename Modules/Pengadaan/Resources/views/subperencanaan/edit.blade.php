@extends('adminlte::page')
@section('title', 'Edit Pengadaan')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">

            <form method="POST" action="{{ url('subperencanaan/update/' . $subperencanaan->id) }}" accept-charset="UTF-8"
                class="form-horizontal" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}

                @include ('pengadaan::subperencanaan.form', [
                    'formMode' => $formMode,
                    'perencanaans' => $perencanaans,
                    'ppk' => $ppk,
                    'units' => $units,
                ])
            </form>

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
