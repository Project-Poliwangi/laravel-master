@extends('peminjamanruangan::layouts.master')

@section('title', $title)
@section('content')
    <div class="row mb-3">
        <div class="col-sm-12 col-12">
            <h4 style="font-weight: bold">{{ strtoupper($title) }}</h4>
        </div>
    </div>

    <div class="col-sm-6 col-12">
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <form action="{{ $action }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Mata Kuliah</label>
                        <select name="mata_kuliah_id" class="form-control @error('mata_kuliah_id') is-invalid @enderror">
                            <option value=""></option>
                            @foreach($matakuliahs as $matakuliah)
                                <option value="{{ $matakuliah->id }}" @if(old('mata_kuliah_id', isset($data) ? $data->mata_kuliah_id : '') == $matakuliah->id) selected @endif>{{ $matakuliah->kode }} - {{ $matakuliah->nama }}</option>
                            @endforeach
                        </select>
                        @error('mata_kuliah_id')
                            <i class="text-danger small mx-2">{{ $message }}</i>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label for="">Semester</label>
                                <input type="number" name="semester" class="form-control @error('semester') is-invalid @enderror" value="{{ old('semester', isset($data) ? $data->semester : '') }}">
                                @error('semester')
                                    <i class="text-danger small mx-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <input type="text" name="kelas" class="form-control @error('kelas') is-invalid @enderror" value="{{ old('kelas', isset($data) ? $data->kelas : '') }}">
                                @error('kelas')
                                    <i class="text-danger small mx-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Program Studi</label>
                        <select name="program_studi_id" class="form-control @error('program_studi_id') is-invalid @enderror">
                            <option value=""></option>
                            @foreach($programStudis as $programStudi)
                                <option value="{{ $programStudi->id }}" @if(old('program_studi_id', isset($data) ? $data->program_studi_id : '') == $programStudi->id) selected @endif>{{ $programStudi->nama }}</option>
                            @endforeach
                        </select>
                        @error('program_studi_id')
                            <i class="text-danger small mx-2">{{ $message }}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Dosen</label>
                        <select name="dosen_id" class="form-control @error('dosen_id') is-invalid @enderror">
                            <option value=""></option>
                            @foreach($pegawais as $pegawai)
                                <option value="{{ $pegawai->id }}" @if(old('dosen_id', isset($data) ? $data->dosen_id : '') == $pegawai->id) selected @endif>{{ $pegawai->NIK }} - {{ $pegawai->nama }}</option>
                            @endforeach
                        </select>
                        @error('dosen_id')
                            <i class="text-danger small mx-2">{{ $message }}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Hari</label>
                        <input type="text" name="hari" class="form-control @error('hari') is-invalid @enderror" value="{{ old('hari', isset($data) ? $data->hari : '') }}">
                        @error('hari')
                            <i class="text-danger small mx-2">{{ $message }}</i>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label for="">Jam Mulai</label>
                                <input type="time" name="jam_mulai" id="" class="form-control @error('jam_mulai') is-invalid @enderror" value="{{ old('jam_mulai', isset($data) ? $data->jam_mulai : '') }}">
                                @error('jam_mulai')
                                    <i class="text-danger small mx-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label for="">Jam Selesai</label>
                                <input type="time" name="jam_selesai" id="" class="form-control @error('jam_selesai') is-invalid @enderror" value="{{ old('jam_selesai', isset($data) ? $data->jam_selesai : '') }}">
                                @error('jam_selesai')
                                    <i class="text-danger small mx-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Ruang</label>
                        <select name="ruang_id" class="form-control @error('ruang_id') is-invalid @enderror">
                            <option value=""></option>
                            @foreach($ruangs as $ruang)
                                <option value="{{ $ruang->id }}" @if(old('ruang_id', isset($data) ? $data->ruang_id : '') == $ruang->id) selected @endif>{{ $ruang->kode_bmn }} - {{ $ruang->nama}} ({{ $ruang->kapasitas }})</option>
                            @endforeach
                        </select>
                        @error('ruang_id')
                            <i class="text-danger small mx-2">{{ $message }}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', isset($data) ? $data->description : '') }}</textarea>
                        @error('description')
                            <i class="text-danger small mx-2">{{ $message }}</i>
                        @enderror
                    </div>
                    <hr>
                    <div class="col-12 text-right">
                        <a href="{{ route('penjadwalan') }}" class="btn btn-secondary">Batal</a>
                        <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection