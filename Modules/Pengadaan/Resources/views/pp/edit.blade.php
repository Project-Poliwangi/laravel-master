@extends('adminlte::page')
@section('title', 'Edit Pengadaan')
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

                    <form method="POST" action="{{ url('pp/update/' . $subPerencanaan->id) }}" accept-charset="UTF-8"
                        class="form-horizontal" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}

                        @include ('pengadaan::pp.form', ['formMode' => $formMode, 'subPerencanaan' => $subPerencanaan, 'metodepengadaans' => $metodepengadaans, 'pengadaan' => $pengadaan, 'jenisPengadaans' => $jenisPengadaans, 'pengadaanstatus' => $pengadaanstatus, 'unit' => $unit])

                    </form>
                </div>

            </div>

        </div>
    </div>
@endsection
