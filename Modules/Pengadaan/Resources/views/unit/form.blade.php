<!-- Basic Horizontal form layout section start -->
<section id="basic-horizontal-layouts">
    <div class="row match-height">
        <div class="col-md-12 col-12">
            <form class="form form-horizontal">
                <div class="form-body">
                    <div class="row">
                        {{-- Fields for subPerencanaan --}}
                        <div class="col-md-6 form-group">
                            <label for="perencanaan" class="control-label">{{ 'Perencanaan' }}</label>
                            <input class="form-control" name="perencanaan" type="text" disabled id="perencanaan"
                                value="{{ isset($subPerencanaan->perencanaan->nama) ? $subPerencanaan->perencanaan->nama : old('perencanaan') }}">
                            {!! $errors->first('perencanaan', '<p class="help-block">:message</p>') !!}
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="kegiatan" class="control-label">{{ 'Kegiatan' }}</label>
                            <input class="form-control" name="kegiatan" type="text" disabled id="kegiatan"
                                value="{{ isset($subPerencanaan->kegiatan) ? $subPerencanaan->kegiatan : old('kegiatan') }}">
                            {!! $errors->first('kegiatan', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <!-- Satuan and Volume -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="satuan" class="col-sm-4 col-form-label">{{ 'Satuan' }}</label>
                                <div class="col-sm-8 form-group {{ $errors->has('satuan') ? 'has-error' : '' }}">
                                    <input class="form-control" name="satuan" type="text" id="satuan"
                                        value="{{ isset($subPerencanaan->satuan) ? $subPerencanaan->satuan : old('satuan') }}">
                                    {!! $errors->first('satuan', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="volume" class="col-sm-4 col-form-label">{{ 'Volume' }}</label>
                                <div class="col-sm-8 form-group {{ $errors->has('volume') ? 'has-error' : '' }}">
                                    <input class="form-control" name="volume" type="number" id="volume"
                                        value="{{ isset($subPerencanaan->volume) ? $subPerencanaan->volume : old('volume') }}">
                                    {!! $errors->first('volume', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Harga Satuan and Output -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="harga_satuan" class="col-sm-4 col-form-label">{{ 'Harga Satuan' }}</label>
                                <div class="col-sm-8 form-group {{ $errors->has('harga_satuan') ? 'has-error' : '' }}">
                                    <input class="form-control" name="harga_satuan" type="number" id="harga_satuan"
                                        value="{{ isset($subPerencanaan->harga_satuan) ? $subPerencanaan->harga_satuan : old('harga_satuan') }}">
                                    {!! $errors->first('harga_satuan', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="output" class="col-sm-4 col-form-label">{{ 'Output' }}</label>
                                <div class="col-sm-8 form-group {{ $errors->has('output') ? 'has-error' : '' }}">
                                    <input class="form-control" name="output" type="text" id="output"
                                        value="{{ isset($subPerencanaan->output) ? $subPerencanaan->output : old('output') }}">
                                    {!! $errors->first('output', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rencana Mulai and Rencana Bayar -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="rencana_mulai"
                                    class="col-sm-4 col-form-label">{{ 'Rencana Mulai' }}</label>
                                <div
                                    class="col-sm-8 form-group {{ $errors->has('rencana_mulai') ? 'has-error' : '' }}">
                                    <input class="form-control" name="rencana_mulai" type="date" id="rencana_mulai"
                                        value="{{ isset($subPerencanaan->rencana_mulai) ? $subPerencanaan->rencana_mulai : old('rencana_mulai') }}">
                                    {!! $errors->first('rencana_mulai', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="rencana_bayar"
                                    class="col-sm-4 col-form-label">{{ 'Rencana Bayar' }}</label>
                                <div
                                    class="col-sm-8 form-group {{ $errors->has('rencana_bayar') ? 'has-error' : '' }}">
                                    <input class="form-control" name="rencana_bayar" type="date" id="rencana_bayar"
                                        value="{{ isset($subPerencanaan->rencana_bayar) ? $subPerencanaan->rencana_bayar : old('rencana_bayar') }}">
                                    {!! $errors->first('rencana_bayar', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Dokumen KAK dan Dokumen HPS --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="dokumen_kak" class="col-sm-4 col-form-label">{{ 'Dokumen KAK' }}</label>
                                <div class="col-sm-8 form-group {{ $errors->has('dokumen_kak') ? 'has-error' : '' }}">
                                    <!-- Basic file uploader -->
                                    <input type="file" name="dokumen_kak" class="basic-filepond"><small
                                        class="form-text text-muted">*Format PDF dengan maksimal ukuran file 10
                                        MB</small>
                                    @if (isset($pengadaan->dokumen_kak))
                                        <p>Dokumen KAK sudah ada : <a
                                                href="{{ asset('storage/dokumen_kak/' . $pengadaan->dokumen_kak) }}"
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
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="dokumen_hps" class="col-sm-4 col-form-label">{{ 'Dokumen HPS' }}</label>
                                <div class="col-sm-8 form-group {{ $errors->has('dokumen_hps') ? 'has-error' : '' }}">
                                    <!-- Basic file uploader -->
                                    <input type="file" name="dokumen_hps" class="basic-filepond"><small
                                        class="form-text text-muted">*Format PDF dengan maksimal ukuran file 10
                                        MB</small>
                                    @if (isset($pengadaan->dokumen_hps))
                                        <p>Dokumen HPS sudah ada : <a
                                                href="{{ asset('storage/dokumen_hps/' . $pengadaan->dokumen_hps) }}"
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
                            </div>
                        </div>
                    </div>

                    {{-- Dokumen Stock Opname dan Dokumen Surat Ijin Impor --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="dokumen_stock_opname"
                                    class="col-sm-4 col-form-label">{{ 'Dokumen Stock Opname' }}</label>
                                <div
                                    class="col-sm-8 form-group {{ $errors->has('dokumen_stock_opname') ? 'has-error' : '' }}">
                                    <!-- Basic file uploader -->
                                    <input type="file" name="dokumen_stock_opname" class="basic-filepond"><small
                                        class="form-text text-muted">*Format PDF dengan maksimal ukuran file 10
                                        MB</small>
                                    @if (isset($pengadaan->dokumen_stock_opname))
                                        <p>Dokumen Stock Opname sudah ada : <a
                                                href="{{ asset('storage/dokumen_stock_opname/' . $pengadaan->dokumen_stock_opname) }}"
                                                target="_blank">Lihat Dokumen</a></p>
                                        <input type="hidden" name="existing_dokumen_stock_opname"
                                            value="{{ $pengadaan->dokumen_stock_opname }}">
                                    @endif
                                    @if ($errors->has('dokumen_stock_opname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('dokumen_stock_opname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="dokumen_surat_ijin_impor"
                                    class="col-sm-4 col-form-label">{{ 'Dokumen Surat Ijin Impor' }}</label>
                                <div
                                    class="col-sm-8 form-group {{ $errors->has('dokumen_surat_ijin_impor') ? 'has-error' : '' }}">
                                    <!-- Basic file uploader -->
                                    <input type="file" name="dokumen_surat_ijin_impor"
                                        class="basic-filepond"><small class="form-text text-muted">*Format PDF dengan
                                        maksimal ukuran file 10 MB</small>
                                    @if (isset($pengadaan->dokumen_surat_ijin_impor))
                                        <p>Dokumen Surat Ijin Impor sudah ada : <a
                                                href="{{ asset('storage/dokumen_ijin_impor/' . $pengadaan->dokumen_surat_ijin_impor) }}"
                                                target="_blank">Lihat Dokumen</a></p>
                                        <input type="hidden" name="existing_dokumen_surat_ijin_impor"
                                            value="{{ $pengadaan->dokumen_surat_ijin_impor }}">
                                    @endif
                                    @if ($errors->has('dokumen_surat_ijin_impor'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('dokumen_surat_ijin_impor') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="pic" class="col-sm-4 col-form-label">{{ 'PIC' }}</label>
                                <div class="col-sm-8 form-group {{ $errors->has('pic_id') ? 'has-error' : '' }}">
                                    <select name="pic_id" class="form-control" id="pic_id" required>
                                        <option value="">Pilih PIC</option>
                                        <!-- Tambahkan opsi default jika diperlukan -->
                                        @foreach ($pics as $pic)
                                            <option value="{{ $pic->id }}"
                                                {{ isset($subPerencanaan) && $subPerencanaan->pic_id == $pic->id ? 'selected' : '' }}>
                                                {{ $pic->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('pic_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex justify-content-end">
                        <button class="btn btn-warning" onclick="history.back();">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                        </button>&nbsp;
                        <button type="submit" class="btn btn-success">
                            {{ $formMode === 'create' ? 'Simpan' : 'Edit' }}
                        </button>
                    </div>

                    <!-- Skrip SweetAlert -->
                    @if (session('success_edit'))
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: "{{ session('success') }}",
                                    showConfirmButton: true,
                                    confirmButtonText: 'OK',
                                    customClass: {
                                        popup: 'swal-wide',
                                        confirmButton: 'btn btn-success'
                                    }
                                });
                            });
                        </script>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>
<!-- // Basic Horizontal form layout section end -->
