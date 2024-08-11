<!-- Basic Horizontal form layout section start -->
<section id="basic-horizontal-layouts">
    <div class="row match-height justify-content-center">
        <div class="col-md-12 col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="nama_dokumen"
                            class="col-md-4 col-form-label text-md-right">{{ __('Nama Dokumen') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="nama_dokumen"
                                value="{{ isset($documents->nama_dokumen) ? $documents->nama_dokumen : old('nama_dokumen') }}">
                            @if ($errors->has('nama_dokumen'))
                                <span class="text-danger">{{ $errors->first('nama_dokumen') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('File') }}</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control-file" name="file">
                            <small class="form-text text-muted">*Format doc, docx, xls, xlsx dengan maksimal ukuran
                                file 10 MB</small>
                            @if (isset($documents->file))
                                <p>Dokumen saat ini: <a href="{{ url('storage/dokumen_template/' . $documents->file) }}"
                                        target="_blank">{{ $documents->file }}</a></p>
                                <input type="hidden" name="existing_file" value="{{ $documents->file }}">
                            @endif
                            @if ($errors->has('file'))
                                <span class="text-danger">{{ $errors->first('file') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="deskripsi"
                            class="col-md-4 col-form-label text-md-right">{{ __('Deskripsi') }}</label>
                        <div class="col-md-6">
                            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="4">{{ isset($documents->deskripsi) ? $documents->deskripsi : old('deskripsi') }}</textarea>
                            @if ($errors->has('deskripsi'))
                                <span class="text-danger">{{ $errors->first('deskripsi') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4 d-flex justify-content-between">
                            <button type="button" class="btn btn-warning" onclick="history.back();">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                            </button>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Simpan') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- // Basic Horizontal form layout section end -->
