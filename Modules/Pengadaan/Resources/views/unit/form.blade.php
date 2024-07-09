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
                                        <label for="nomor_surat" class="control-label">{{ 'Nomor Surat' }}</label>
                                    </div>
                                    <div
                                        class="col-md-8 form-group {{ $errors->has('nomor_surat') ? 'has-error' : '' }}">
                                        <input class="form-control" name="nomor_surat" type="text" id="nomor_surat"
                                            value="{{ isset($pengadaan->nomor_surat) ? $pengadaan->nomor_surat : old('nomor_surat') }}">
                                        {!! $errors->first('nomor_surat', '<p class="help-block">:message</p>') !!}
                                    </div>
                                    <div class="col-md-4">
                                        <label for="jenis_pengadaan"
                                            class="control-label">{{ 'Jenis Pengadaan' }}</label>
                                    </div>
                                    <div
                                        class="col-md-8 form-group {{ $errors->has('jenis_pengadaan') ? 'has-error' : '' }}">
                                        <select name="jenis_pengadaan" id="jenis_pengadaan" class="form-control">
                                            <option value="" disabled selected>--- Pilih Jenis Pengadaan ---
                                            </option>
                                            <option value="barang"
                                                {{ isset($pengadaan->jenis_pengadaan) ? ($pengadaan->jenis_pengadaan == 'Barang' ? 'selected' : '') : (old('jenis_pengadaan') == 'Barang' ? 'selected' : '') }}>
                                                Barang</option>
                                            <option value="jasa"
                                                {{ isset($pengadaan->jenis_pengadaan) ? ($pengadaan->jenis_pengadaan == 'Jasa' ? 'selected' : '') : (old('jenis_pengadaan') == 'Jasa' ? 'selected' : '') }}>
                                                Jasa</option>
                                            <option value="perbaikan"
                                                {{ isset($pengadaan->jenis_pengadaan) ? ($pengadaan->jenis_pengadaan == 'Perbaikan' ? 'selected' : '') : (old('jenis_pengadaan') == 'Perbaikan' ? 'selected' : '') }}>
                                                Perbaikan</option>
                                            <option value="kegiatan"
                                                {{ isset($pengadaan->jenis_pengadaan) ? ($pengadaan->jenis_pengadaan == 'Kegiatan' ? 'selected' : '') : (old('jenis_pengadaan') == 'Kegiatan' ? 'selected' : '') }}>
                                                Kegiatan</option>
                                            <option value="konstruksi"
                                                {{ isset($pengadaan->jenis_pengadaan) ? ($pengadaan->jenis_pengadaan == 'Konstruksi' ? 'selected' : '') : (old('jenis_pengadaan') == 'Konstruksi' ? 'selected' : '') }}>
                                                Konstruksi</option>
                                        </select>
                                        {!! $errors->first('jenis_pengadaan', '<p class="help-block">:message</p>') !!}
                                    </div>
                                    <div class="col-md-4">
                                        <label for="total_biaya" class="control-label">{{ 'Total Biaya' }}</label>
                                    </div>
                                    <div
                                        class="col-md-8 form-group {{ $errors->has('total_biaya') ? 'has-error' : '' }}">
                                        <input class="form-control" name="total_biaya" type="number" id="total_biaya"
                                            value="{{ isset($pengadaan->total_biaya) ? $pengadaan->total_biaya : old('total_biaya') }}">
                                        {!! $errors->first('total_biaya', '<p class="help-block">:message</p>') !!}
                                    </div>
                                    <div class="col-md-4">
                                        <label for="dokumen_kak" class="control-label">Kerangka Acuan Kerja
                                            (KAK)</label>
                                    </div>
                                    <div
                                        class="col-md-8 form-group {{ $errors->has('dokumen_kak') ? 'has-error' : '' }}">
                                        <!-- Basic file uploader -->
                                        <input type="file" name="dokumen_kak" class="basic-filepond">
                                        @if (isset($pengadaan->dokumen_kak))
                                            <p>Dokumen KAK sudah ada : <a
                                                    href="{{ asset('storage/assets/dokumen/dokumen_kak/' . $pengadaan->dokumen_kak) }}"
                                                    target="_blank">Lihat Dokumen</a></p>
                                            <input type="hidden" name="existing_dokumen_kak"
                                                value="{{ $pengadaan->dokumen_kak }}">
                                        @endif
                                        @if ($errors->has('dokumen_kak'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('dokumen_kak') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label>Harga Perkiraan Sendiri (HPS)</label>
                                    </div>
                                    <div
                                        class="col-md-8 form-group {{ $errors->has('dokumen_hps') ? 'has-error' : '' }}">
                                        <!-- Basic file uploader -->
                                        <input type="file" name="dokumen_hps" class="basic-filepond">
                                        @if (isset($pengadaan->dokumen_hps))
                                            <p>Dokumen HPS sudah ada : <a
                                                    href="{{ asset('storage/assets/dokumen/dokumen_hps/' . $pengadaan->dokumen_hps) }}"
                                                    target="_blank">Lihat Dokumen</a></p>
                                            <input type="hidden" name="existing_dokumen_hps"
                                                value="{{ $pengadaan->dokumen_hps }}">
                                        @endif
                                        @if ($errors->has('dokumen_hps'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('dokumen_hps') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label>Stock Opname</label>
                                    </div>
                                    <div
                                        class="col-md-8 form-group {{ $errors->has('dokumen_stock_opname') ? 'has-error' : '' }}">
                                        <!-- Basic file uploader -->
                                        <input type="file" name="dokumen_stock_opname" class="basic-filepond">
                                        @if (isset($pengadaan->dokumen_stock_opname))
                                            <p>Dokumen Stock Opname sudah ada : <a
                                                    href="{{ asset('storage/assets/dokumen/dokumen_stock_opname/' . $pengadaan->dokumen_stock_opname) }}"
                                                    target="_blank">Lihat Dokumen</a></p>
                                            <input type="hidden" name="existing_dokumen_so"
                                                value="{{ $pengadaan->dokumen_stock_opname }}">
                                        @endif
                                        @if ($errors->has('dokumen_stock_opname'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('dokumen_stock_opname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label>Surat Ijin Impor</label>
                                    </div>
                                    <div
                                        class="col-md-8 form-group {{ $errors->has('dokumen_surat_ijin_impor') ? 'has-error' : '' }}">
                                        <!-- Basic file uploader -->
                                        <input type="file" name="dokumen_surat_ijin_impor" class="basic-filepond">
                                        @if (isset($pengadaan->dokumen_surat_ijin_impor))
                                            <p>Dokumen Surat Ijin Impor sudah ada : <a
                                                    href="{{ asset('storage/assets/dokumen/dokumen_ijin_impor/' . $pengadaan->dokumen_surat_ijin_impor) }}"
                                                    target="_blank">Lihat Dokumen</a></p>
                                            <input type="hidden" name="existing_dokumen_ijin_impor"
                                                value="{{ $pengadaan->dokumen_surat_ijin_impor }}">
                                        @endif
                                        @if ($errors->has('dokumen_surat_ijin_impor'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('dokumen_surat_ijin_impor') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <button type="button" class="btn btn-warning" onclick="history.back();">
                                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                                        </button>&nbsp;
                                        <button type="submit" class="btn btn-success">
                                            {{ $formMode === 'create' ? 'Simpan' : 'Edit' }}
                                        </button>
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
