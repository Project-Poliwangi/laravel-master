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
                    <div class="row align-items-center">
                        <div class="col-sm-7 col-12">
                            <div class="form-group">
                                <label for="">Kode Gedung <span class="text-danger">*</span></label>
                                <input type="text" name="kode" class="form-control @error('kode') is-invalid @enderror" value="{{ old('kode', isset($gedung) ? $gedung->kode : '') }}">
                                @error('kode')
                                    <i class="text-danger small mx-2">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Nama Gedung <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', isset($gedung) ? $gedung->nama : '') }}">
                                @error('nama')
                                    <i class="text-danger small mx-2">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Lokasi <span class="text-danger">*</span></label>
                                <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', isset($gedung) ? $gedung->lokasi : '') }}">
                                @error('lokasi')
                                    <i class="text-danger small mx-2">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Luas <span class="text-danger">*</span></label>
                                <input type="number" name="luas" class="form-control @error('luas') is-invalid @enderror" value="{{ old('luas', isset($gedung) ? $gedung->luas : '') }}">
                                @error('luas')
                                    <i class="text-danger small mx-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-5 col-12">
                            <div class="col-9 mx-auto file-render">
                                <label for="fileInput">
                                    <img src="{{ asset('storage/images/blank_images.jpg') }}" width="100%"
                                    class="image-preview" @error('file') style="border: 1px solid red" @enderror  alt="">
                                    <div type="button" class="btn btn-secondary btn-block mt-3 mb-0">Upload Foto</div>
                                </label>
                                <input type="file" name="file" id="fileInput" class="file-input d-none">
                                @error('file')
                                    <i class="text-danger small mx-2">{{ $message }}</i>
                                @enderror
                                @if(isset($gedung))
                                    <i class="text-muted small">*Jika tidak ingin mengubah foto, maka tidak perlu diisi</i>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
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