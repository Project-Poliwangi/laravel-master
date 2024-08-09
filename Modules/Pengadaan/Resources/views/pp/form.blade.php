<!-- Basic Horizontal form layout section start -->
<section id="basic-horizontal-layouts">
    <div class="row match-height">
        <div class="col-md-12 col-12">
            <form class="form form-horizontal">
                <div class="form-body">
                    <div class="row">

                        <div class="col-md-6 form-group">
                            <label for="perencanaan" class="control-label">{{ 'Perencanaan' }}</label>
                            <input class="form-control" name="perencanaan" type="text" disabled id="perencanaan"
                                value="{{ isset($subPerencanaan->perencanaans->nama) ? $subPerencanaan->perencanaans->nama : old('perencanaan') }}">
                            {!! $errors->first('perencanaan', '<p class="help-block">:message</p>') !!}
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
                                    <select class="form-control" disabled id="metode_pengadaan_id"
                                        name="metode_pengadaan_id" required>
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
                                    {!! $errors->first('metode_pengadaan_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="jenis" class="col-sm-4 col-form-label">{{ 'Jenis Pengadaan' }}</label>
                                <div
                                    class="col-sm-8 form-group">
                                    <select class="form-control" disabled id="jenis_pengadaan_id"
                                        name="jenis_pengadaan_id" required>
                                        @foreach ($jenisPengadaans as $jenis)
                                            <option value="{{ $jenis->id }}"
                                                {{ isset($subperencanaan) && $subperencanaan->jenis_pengadaan_id == $jenis->id ? 'selected' : '' }}>
                                                {{ $jenis->nama_jenis }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('jenis_pengadaan_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Satuan and Volume -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="satuan" class="col-sm-4 col-form-label">{{ 'Satuan' }}</label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" name="satuan" type="text" disabled id="satuan"
                                        value="{{ isset($subPerencanaan->satuan) ? $subPerencanaan->satuan : old('satuan') }}">
                                    {!! $errors->first('satuan', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="volume" class="col-sm-4 col-form-label">{{ 'Volume' }}</label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" name="volume" type="number" disabled id="volume"
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
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" name="harga_satuan" type="number" disabled
                                        id="harga_satuan"
                                        value="{{ isset($subPerencanaan->harga_satuan) ? $subPerencanaan->harga_satuan : old('harga_satuan') }}">
                                    {!! $errors->first('harga_satuan', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="output" class="col-sm-4 col-form-label">{{ 'Output' }}</label>
                                <div class="col-sm-8 form-group">
                                    <input class="form-control" name="output" type="text" disabled id="output"
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
                                    class="col-sm-8 form-group">
                                    <input class="form-control" name="rencana_mulai" type="date" disabled
                                        id="rencana_mulai"
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
                                    class="col-sm-8 form-group">
                                    <input class="form-control" name="rencana_bayar" type="date" disabled
                                        id="rencana_bayar"
                                        value="{{ isset($subPerencanaan->rencana_bayar) ? $subPerencanaan->rencana_bayar : old('rencana_bayar') }}">
                                    {!! $errors->first('rencana_bayar', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Status and Upload Document -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="status" class="col-sm-4 col-form-label">{{ 'Status' }}</label>
                                <div class="col-sm-8 form-group">
                                    <input type="text" disabled id="status" class="form-control"
                                        value="{{ isset($pengadaan) ? $pengadaan->status->nama_status : '' }}"
                                        disabled>
                                    <input type="hidden" id="status_id" name="status_id"
                                        value="{{ isset($pengadaan->status_id) ? $pengadaan->status_id : '' }}">
                                    {!! $errors->first('status_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        @if ($pengadaan->status->nama_status == 'Pemilihan Penyedia')
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="dokumen_pemilihan_penyedia"
                                        class="col-sm-4 col-form-label">{{ 'Dokumen' }}</label>
                                    <div
                                        class="col-sm-8 form-group">
                                        <!-- Basic file uploader -->
                                        <input type="file" name="dokumen_pemilihan_penyedia"
                                            class="basic-filepond"><small class="form-text text-muted">*Format PDF
                                            dengan maksimal ukuran file 10 MB</small>
                                        @if (isset($pengadaan->dokumen_pemilihan_penyedia))
                                            <p>Dokumen sudah ada : <a
                                                    href="{{ Storage::url($pengadaan->dokumen_pemilihan_penyedia) }}"
                                                    target="_blank">Lihat Dokumen</a></p>
                                            <input type="hidden" name="existing_dokumen_pemilihan_penyedia"
                                                value="{{ $pengadaan->dokumen_pemilihan_penyedia }}">
                                        @endif
                                        @if ($errors->has('dokumen_pemilihan_penyedia'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('dokumen_hps') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-warning" onclick="history.back();">
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
