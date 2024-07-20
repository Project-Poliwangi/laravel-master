@extends('adminlte::page')

@section('title', $title)
@section('content')
    <div class="col-sm-8 col-12">
        <h4 style="font-weight: bold">{{ strtoupper($title) }}</h4>
    </div>
    <div class="col-sm-8 col-12">
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <form action="" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-7 col-12">
                            <div class="form-group">
                                <label for="">Kode Gedung</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Gedung</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Lokasi</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Luas</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-5 col-12"></div>
                    </div>
                    <hr>
                    <button class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection