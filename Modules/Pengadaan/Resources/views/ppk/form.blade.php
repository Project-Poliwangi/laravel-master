<!-- Basic Horizontal form layout section start -->
<section id="basic-horizontal-layouts">
    <div class="row match-height">
        <div class="col-md-12 col-12">
            <form class="form form-horizontal">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="akun_belanja" class="control-label">{{ 'Akun Belanja' }}</label>
                            <input class="form-control" name="perencanaan_id" type="text" disabled id="perencanaan_id"
                                value="{{ isset($subPerencanaan->perencanaans->nama) ? $subPerencanaan->perencanaans->nama : old('perencanaan') }}">
                            {!! $errors->first('akun belanja', '<p class="help-block">:message</p>') !!}
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="kegiatan" class="control-label">{{ 'Kegiatan' }}</label>
                            <input class="form-control" name="kegiatan" type="text" disabled id="kegiatan"
                                value="{{ isset($subPerencanaan->kegiatan) ? $subPerencanaan->kegiatan : old('kegiatan') }}">
                            {!! $errors->first('kegiatan', '<p class="help-block">:message</p>') !!}
                        </div>
                        <!-- Metode and Jenis -->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="metode" class="col-sm-4 col-form-label">{{ 'Metode Pengadaan' }}</label>
                                <div
                                    class="col-sm-8 form-group  {{ $errors->has('metode_pengadaan_id') ? 'has-error' : '' }}">
                                    <select class="form-control" id="metode_pengadaan_id" name="metode_pengadaan_id"
                                        required>
                                        <option value="" disabled
                                            {{ old('metode_pengadaan_id', isset($subPerencanaan->metode_pengadaaan_id) ? $subPerencanaan->metode_pengadaan_id : '') == '' ? 'selected' : '' }}>
                                            --- Pilih Metode Pengadaan ---</option>
                                        @foreach ($metodepengadaans as $metode)
                                            <option value="{{ $metode->id }}"
                                                {{ isset($subPerencanaan) && $subPerencanaan->metode_pengadaan_id == $metode->id ? 'selected' : '' }}>
                                                {{ $metode->nama_metode }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('metode pengadaan ', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="jenis" class="col-sm-4 col-form-label">{{ 'Jenis Pengadaan' }}</label>
                                <div class="col-sm-8 form-group ">
                                    <input class="form-control" name="jenis_pengadaan_id" type="text" disabled
                                        id="jenis_pengadaan_id"
                                        value="{{ isset($subPerencanaan->jenisPengadaans->nama_jenis) ? $subPerencanaan->jenisPengadaans->nama_jenis : old('jenis_pengadaan') }}">
                                    {!! $errors->first('jenis pengadaan', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
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
                                    <input class="form-control" name="rencana_bayar" type="date"
                                        id="rencana_bayar"
                                        value="{{ isset($subPerencanaan->rencana_bayar) ? $subPerencanaan->rencana_bayar : old('rencana_bayar') }}">
                                    {!! $errors->first('rencana_bayar', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Fields for Pengadaan documents --}}
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

                    <!-- PP and Status -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="pp"
                                    class="col-sm-4 col-form-label">{{ 'Pejabat Pengadaan (PP)' }}</label>
                                <div class="col-sm-8 form-group {{ $errors->has('pp_id') ? 'has-error' : '' }}">
                                    <select name="pp_id" class="form-control" id="pp_id" required>
                                        <option value="">Pilih PP</option>
                                        <!-- Tambahkan opsi default jika diperlukan -->
                                        @foreach ($pps as $pp)
                                            <option value="{{ $pp->id }}"
                                                {{ isset($subPerencanaan) && $subPerencanaan->pp_id == $pp->id ? 'selected' : '' }}>
                                                {{ $pp->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('pp_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form catatan -->
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="catatan" class="control-label">{{ 'Catatan' }}</label>
                            <div class="col-md-6 form-group {{ $errors->has('status_id') ? 'has-error' : '' }}">
                                @if (isset($pengadaan) && isset($pengadaan->status) && $pengadaan->status->nama_status == 'Pemenuhan Dokumen')
                                    <textarea id="catatan" name="catatan" rows="4" class="form-control"
                                        placeholder="Tulis catatan jika dokumen belum terpenuhi...">{{ old('catatan', $pengadaan->catatan) }}</textarea>
                                    <small class="form-text text-muted">Catatan ini hanya akan terlihat ketika status
                                        pengadaan adalah "Pemenuhan Dokumen".</small>
                                @else
                                    <textarea id="catatan" name="catatan" rows="4" class="form-control" disabled
                                        placeholder="Catatan tidak tersedia untuk status ini.">{{ old('catatan', isset($pengadaan) ? $pengadaan->catatan : '') }}</textarea>
                                    <small class="form-text text-muted">Catatan hanya dapat ditambahkan ketika status
                                        pengadaan adalah "Pemenuhan Dokumen".</small>
                                @endif
                            </div>
                            {!! $errors->first('catatan', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex justify-content-end">
                        <button class="btn btn-warning" onclick="history.back();">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                        </button>&nbsp;
                        <button type="submit" class="btn btn-success">
                            {{ 'Simpan' }}
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
