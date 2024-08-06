@extends('adminlte::page')

@section('title', $title)
@section('content')
    <div class="col-sm-8 col-12">
        <h4 style="font-weight: bold">{{ strtoupper($title) }}</h4>
    </div>
    <div class="col-sm-8 col-12">
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <form action="{{ $action }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-7 col-12">
                            <div class="form-group">
                                <label for="">Nama Gedung <span class="text-danger">*</span></label>
                                <select name="gedung_id" class="form-control @error('gedung_id') is-invalid @enderror">
                                    <option value=""></option>
                                    @foreach($gedungs as $gedung)
                                        <option value="{{ $gedung->id }}" @if(old('gedung_id', isset($ruang) ? $ruang->gedung_id : '') == $gedung->id) selected @endif>{{ $gedung->kode }} - {{ $gedung->nama }}</option>
                                    @endforeach
                                </select>
                                @error('gedung_id')
                                    <i class="text-danger small mx-2">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Kode Ruangan <span class="text-danger">*</span></label>
                                <input type="text" name="kode_bmn" class="form-control @error('kode_bmn') is-invalid @enderror" value="{{ old('kode_bmn', isset($ruang) ? $ruang->nama : '') }}">
                                @error('kode_bmn')
                                    <i class="text-danger small mx-2">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Kode QR <span class="text-danger">*</span></label>
                                <input type="text" readonly name="kode_qr" class="form-control @error('kode_qr') is-invalid @enderror" value="{{ old('kode_qr', isset($ruang) ? $ruang->kode_qr : strtoupper(\Str::random())) }}">
                                @error('kode_qr')
                                    <i class="text-danger small mx-2">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Nama Ruangan <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', isset($ruang) ? $ruang->nama : '') }}">
                                @error('nama')
                                    <i class="text-danger small mx-2">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Luas <span class="text-danger">*</span></label>
                                <input type="number" name="luas" class="form-control @error('luas') is-invalid @enderror" value="{{ old('luas', isset($ruang) ? $ruang->luas : '') }}">
                                @error('luas')
                                    <i class="text-danger small mx-2">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Kapasitas <span class="text-danger">*</span></label>
                                <input type="number" name="kapasitas" class="form-control @error('kapasitas') is-invalid @enderror" value="{{ old('kapasitas', isset($ruang) ? $ruang->kapasitas : '') }}">
                                @error('kapasitas')
                                    <i class="text-danger small mx-2">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Lantai <span class="text-danger">*</span></label>
                                <input type="number" name="lantai" class="form-control @error('lantai') is-invalid @enderror" value="{{ old('lantai', isset($ruang) ? $ruang->lantai : '') }}">
                                @error('lantai')
                                    <i class="text-danger small mx-2">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kelas <span class="text-danger">*</span></label>
                                <select name="jenis" class="form-control @error('jenis') is-invalid @enderror">
                                    <option value=""></option>
                                    <option value="Interaktif Kelas" @if(old('jenis', isset($ruang) ? $ruang->jenis : '') == 'Interaktif Kelas') selected @endif>Interaktif Kelas</option>
                                    <option value="Classical Kelas" @if(old('jenis', isset($ruang) ? $ruang->jenis : '') == 'Classical Kelas') selected @endif>Classical Kelas</option>
                                    <option value="Ruang Kelas" @if(old('jenis', isset($ruang) ? $ruang->jenis : '') == 'Ruang Kelas') selected @endif>Ruang Kelas</option>
                                    <option value="Ruang Laboratorium" @if(old('jenis', isset($ruang) ? $ruang->jenis : '') == 'Ruang Laboratorium') selected @endif>Ruang Laboratorium</option>
                                    <option value="Ruang Kerja" @if(old('jenis', isset($ruang) ? $ruang->jenis : '') == 'Ruang Kerja') selected @endif>Ruang Kerja</option>
                                    <option value="Ruang Rapat" @if(old('jenis', isset($ruang) ? $ruang->jenis : '') == 'Ruang Rapat') selected @endif>Ruang Rapat</option>
                                    <option value="Fasilitas Olahraga" @if(old('jenis', isset($ruang) ? $ruang->jenis : '') == 'Fasilitas Olahraga') selected @endif>Fasilitas Olahraga</option>
                                    <option value="Aula" @if(old('jenis', isset($ruang) ? $ruang->jenis : '') == 'Aula') selected @endif>Aula</option>
                                </select>
                                @error('luas')
                                    <i class="text-danger small mx-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-5 col-12">
                            <div class="col-9 mx-auto file-render">
                                <label for="fileInput">
                                    <img src="{{ asset('storage/images/blank_images.jpg') }}" width="100%"
                                    class="image-preview" @error('file') style="border: 1px solid red" @enderror alt="">
                                    <div type="button" class="btn btn-secondary btn-block mt-3 mb-0"><i class="fas fa-cloud-upload-alt"></i> Upload Foto</div>
                                </label>
                                <input type="file" name="file" id="fileInput" class="file-input d-none">
                                @error('file')
                                    <i class="text-danger small mx-2">{{ $message }}</i>
                                @enderror
                                @if(isset($ruang))
                                    <i class="text-muted small mb-3">*Jika tidak ingin mengubah foto, maka tidak perlu diisi</i>
                                @endif
                                <button class="btn btn-primary btn-block"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $('.file-input').on('change', function(e) {
            var file = e.target.files[0]; // get the file
            if (file) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    $('.image-preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(file); // convert to base64 string
            }
        });
    </script>
@endsection