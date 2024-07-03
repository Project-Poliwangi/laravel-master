<input type="hidden" name="backurl" value="<?php echo Request::server('HTTP_REFERER') == null ? '/pengadaan/pengadaan' : Request::server('HTTP_REFERER'); ?>">

<!-- Basic Horizontal form layout section start -->
<section id="basic-horizontal-layouts">
    <div class="row match-height">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Formulir Pengajuan Permohonan</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-horizontal">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Nomor Surat</label>
                                    </div>
                                    <div
                                        class="col-md-8 form-group {{ $errors->has('nomor_surat') ? 'has-error' : '' }}">
                                        <input class="form-control" name="nomor_surat" type="text" id="nomor_surat"
                                            value="{{ isset($unit->nomor_surat) ? $unit->nomor_surat : old('nomor_surat') }}">
                                        {!! $errors->first('nomor_surat', '<p class="help-block">:message</p>') !!}
                                    </div>
                                    <div class="col-md-4">
                                        <label>Jenis Pengadaan</label>
                                    </div>
                                    <div
                                        class="col-md-8 form-group {{ $errors->has('jenis_pengadaan') ? 'has-error' : '' }}">
                                        <select name="jenis_pengadaan" id="jenis_pengadaan" class="form-control">
                                            <option value="">--- Pilih Jenis Pengadaan ---</option>
                                            <option value="barang"
                                                {{ isset($unit->jenis_pengadaan) ? ($unit->jenis_pengadaan == 'barang' ? 'selected' : '') : (old('jenis_pengadaan') == 'barang' ? 'selected' : '') }}>
                                                Barang</option>
                                            <option value="jasa"
                                                {{ isset($unit->jenis_pengadaan) ? ($unit->jenis_pengadaan == 'jasa' ? 'selected' : '') : (old('jenis_pengadaan') == 'jasa' ? 'selected' : '') }}>
                                                Jasa</option>
                                            <option value="perbaikan"
                                                {{ isset($unit->jenis_pengadaan) ? ($unit->jenis_pengadaan == 'perbaikan' ? 'selected' : '') : (old('jenis_pengadaan') == 'perbaikan' ? 'selected' : '') }}>
                                                Perbaikan</option>
                                            <option value="kegiatan"
                                                {{ isset($unit->jenis_pengadaan) ? ($unit->jenis_pengadaan == 'kegiatan' ? 'selected' : '') : (old('jenis_pengadaan') == 'kegiatan' ? 'selected' : '') }}>
                                                Kegiatan</option>
                                            <option value="konstruksi"
                                                {{ isset($unit->jenis_pengadaan) ? ($unit->jenis_pengadaan == 'konstruksi' ? 'selected' : '') : (old('jenis_pengadaan') == 'konstruksi' ? 'selected' : '') }}>
                                                Konstruksi</option>
                                        </select>
                                        {!! $errors->first('jenis_pengadaan', '<p class="help-block">:message</p>') !!}
                                    </div>
                                    <div class="col-md-4">
                                        <label>Total Biaya</label>
                                    </div>
                                    <div
                                        class="col-md-8 form-group {{ $errors->has('total_biaya') ? 'has-error' : '' }}">
                                        <input class="form-control" name="total_biaya" type="number" id="total_biaya"
                                            value="{{ isset($unit->total_biaya) ? $unit->total_biaya : old('total_biaya') }}">
                                        {!! $errors->first('total_biaya', '<p class="help-block">:message</p>') !!}
                                    </div>
                                    <div class="col-md-4">
                                        <label>Kerangka Acuan Kerja (KAK)</label>
                                    </div>
                                    <div
                                        class="col-md-8 form-group {{ $errors->has('dokumen_kak') ? 'has-error' : '' }}">
                                        <!-- Basic file uploader -->
                                        <input type="file" class="basic-filepond">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Harga Perkiraan Sendiri (HPS)</label>
                                    </div>
                                    <div
                                        class="col-md-8 form-group {{ $errors->has('dokumen_hps') ? 'has-error' : '' }}">
                                        <!-- Basic file uploader -->
                                        <input type="file" class="basic-filepond">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Stock Opname</label>
                                    </div>
                                    <div
                                        class="col-md-8 form-group {{ $errors->has('dokumen_stock_opname') ? 'has-error' : '' }}">
                                        <!-- Basic file uploader -->
                                        <input type="file" class="basic-filepond">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Surat Ijin Impor</label>
                                    </div>
                                    <div
                                        class="col-md-8 form-group {{ $errors->has('dokumen_surat_ijin_impor') ? 'has-error' : '' }}">
                                        <!-- Basic file uploader -->
                                        <input type="file" class="basic-filepond">
                                    </div>
                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1"
                                            value="{{ $formMode === 'create' ? 'Tambah' : 'Memperbarui' }}">Submit</button>
                                            <a href="{{ url( (Request::server('HTTP_REFERER')==null?'/pengadaan/unit/permohonan':Request::server('HTTP_REFERER')) ) }}" title="Kembali"><button class="btn btn-secondary me-1 mb-1" onclick="window.history.back()">Kembali</button></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- // Basic Horizontal form layout section end -->
