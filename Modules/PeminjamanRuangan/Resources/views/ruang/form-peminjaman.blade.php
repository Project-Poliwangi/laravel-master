@extends('peminjamanruangan::layouts.master')

@section('title', $title)
@section('content')
    <div class="row mb-3">
        <div class="col-sm-12 col-12">
            <h4 style="font-weight: bold" class="my-5">{{ strtoupper($title) }}</h4>
        </div>
    </div>

    <div class="col-md-5 col-sm-10 col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('ruang.store-peminjaman')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Kode Ruangan</label>
                        <select name="ruang_id" class="form-control @error('ruang_id') is-invalid @enderror">
                            <option value=""></option>
                            @foreach($ruangs as $ruang)
                                <option value="{{ $ruang->id }}" @if(old('ruang_id', isset($value) ? $value->id : '') == $ruang->id) selected @endif>{{ $ruang->kode_bmn }} - {{ $ruang->nama}}</option>
                            @endforeach
                        </select>
                        @error('ruang_id')
                            <i class="text-danger small mx-2">{{ $message }}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Kode Program Studi</label>
                        <select name="program_studi_id" class="form-control @error('program_studi_id') is-invalid @enderror">
                            <option value=""></option>
                            @foreach($programStudis as $programStudi)
                                <option value="{{ $programStudi->id }}" @if(old('program_studi_id') == $programStudi->id) selected @endif>{{ $programStudi->nama }}</option>
                            @endforeach
                        </select>
                        @error('program_studi_id')
                            <i class="text-danger small mx-2">{{ $message }}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Kode Mata Kuliah</label>
                        <select name="mata_kuliah_id" class="form-control @error('mata_kuliah_id') is-invalid @enderror">
                            <option value=""></option>
                            @foreach($mataKuliahs as $mataKuliah)
                                <option value="{{ $mataKuliah->id }}" @if(old('mata_kuliah_id') == $mataKuliah->id) selected @endif>{{ $mataKuliah->kode }} - {{ $mataKuliah->nama }}</option>
                            @endforeach
                        </select>
                        @error('mata_kuliah_id')
                            <i class="text-danger small mx-2">{{ $message }}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Kode Dosen</label>
                        <select name="dosen_id" class="form-control @error('dosen_id') is-invalid @enderror">
                            <option value=""></option>
                            @foreach($pegawais as $pegawai)
                                <option value="{{ $pegawai->id }}" @if(old('dosen_id') == $pegawai->id) selected @endif>{{ $pegawai->NIK }} - {{ $pegawai->nama }}</option>
                            @endforeach
                        </select>
                        @error('dosen_id')
                            <i class="text-danger small mx-2">{{ $message }}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Jadwal Mulai</label>
                        <input type="date" name="jadwal_mulai" class="form-control @error('jadwal_mulai') is-invalid @enderror" value="{{ old('jadwal_mulai') }}">
                        @error('jadwal_mulai')
                            <i class="text-danger small mx-2">{{ $message }}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">jadwal Selesai</label>
                        <input type="date" name="jadwal_akhir" class="form-control @error('jadwal_akhir') is-invalid @enderror" value="{{ old('jadwal_akhir') }}">
                        @error('jadwal_akhir')
                            <i class="text-danger small mx-2">{{ $message }}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">NIM</label>
                        <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" value="{{ old('nim') }}">
                        @error('nim')
                            <i class="text-danger small mx-2">{{ $message }}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Jam Mulai</label>
                        <input type="time" name="waktu_mulai" class="form-control @error('waktu_mulai') is-invalid @enderror" value="{{ old('waktu_mulai') }}">
                        @error('waktu_mulai')
                            <i class="text-danger small mx-2">{{ $message }}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Jam Selesai</label>
                        <input type="time" name="waktu_selesai" class="form-control @error('waktu_selesai') is-invalid @enderror" value="{{ old('waktu_selesai') }}">
                        @error('waktu_selesai')
                            <i class="text-danger small mx-2">{{ $message }}</i>
                        @enderror
                    </div>
                    <hr>
                    <div class="col-12 text-right">
                        <a href="javascript:history.back()" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection