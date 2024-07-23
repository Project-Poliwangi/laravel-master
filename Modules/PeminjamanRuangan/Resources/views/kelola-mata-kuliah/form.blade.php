@extends('adminlte::page')

@section('title', $title)
@section('content')
<div class="row">
    <div class="col-12">
        <div class="row align-items-center">
            <div class="col-sm-6 col-12">
                <h4 style="font-weight: bold" class="my-2">{{ strtoupper($title) }}</h4>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="col-md-5 col-sm-8 col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ $action }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Kode Mata Kuliah <i class="text-danger">*</i></label>
                            <input type="text" name="kode" class="form-control @error('kode') is-invalid @enderror" value="{{ old('kode', isset($mataKuliah) ? $mataKuliah->kode : '') }}">
                            @error('kode')
                                <i class="mx-2 text-danger small">{{ $message }}</i>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Program Studi <i class="text-danger">*</i></label>
                            <select name="program_studi_id" class="form-control @error('kode') is-invalid @enderror">
                                <option value=""></option>
                                @foreach($programStudis as $item) 
                                    <option value="{{ $item->id }}" @if(old('program_studi_id', isset($mataKuliah) ? $mataKuliah->program_studi_id : '') === '{{ $item->id }}') selected @endif>{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('program_studi_id')
                                <i class="mx-2 text-danger small">{{ $message }}</i>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Nama Mata Kuliah <i class="text-danger">*</i></label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', isset($mataKuliah) ? $mataKuliah->nama : '') }}">
                            @error('nama')
                                <i class="mx-2 text-danger small">{{ $message }}</i>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Mata Kuliah <i class="text-danger">*</i></label>
                            <select name="jenis" class="form-control @error('kode') is-invalid @enderror">
                                <option value=""></option>
                                <option value="Teori" @if(old('jenis', isset($mataKuliah) ? $mataKuliah->jenis : '') === 'Teori') selected @endif>Teori</option>
                                <option value="Praktikum" @if(old('jenis', isset($mataKuliah) ? $mataKuliah->jenis : '') === 'Praktikum') selected @endif>Praktikum</option>
                                <option value="Teori & Praktikum" @if(old('jenis', isset($mataKuliah) ? $mataKuliah->jenis : '') === 'Teori & Praktikum') selected @endif>Teori & Praktikum</option>
                            </select>
                            @error('jenis')
                                <i class="mx-2 text-danger small">{{ $message }}</i>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah SKS <i class="text-danger">*</i></label>
                            <input type="number" name="sks" class="form-control @error('sks') is-invalid @enderror" value="{{ old('sks', isset($mataKuliah) ? $mataKuliah->sks : '') }}">
                            @error('sks')
                                <i class="mx-2 text-danger small">{{ $message }}</i>
                            @enderror
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection