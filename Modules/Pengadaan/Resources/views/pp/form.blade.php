<!-- Basic Horizontal form layout section start -->
<section id="basic-horizontal-layouts">
    <div class="row match-height">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-horizontal">
                            <div class="form-body">
                                <div class="row">
                                    <!-- Informasi Perencanaan dan Kegiatan -->
                                    <div class="col-md-6 form-group">
                                        <label for="perencanaan" class="control-label">{{ 'Perencanaan' }}</label>
                                        <input class="form-control" name="perencanaan" type="text" disabled
                                            id="perencanaan"
                                            value="{{ isset($subPerencanaan->perencanaan->nama) ? $subPerencanaan->perencanaan->nama : old('perencanaan') }}">
                                            {!! $errors->first('perencanaan', '<p class="text-danger">:message</p>') !!}
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="kegiatan" class="control-label">{{ 'Kegiatan' }}</label>
                                        <input class="form-control" name="kegiatan" type="text" disabled
                                            id="kegiatan"
                                            value="{{ isset($subPerencanaan->kegiatan) ? $subPerencanaan->kegiatan : old('kegiatan') }}">
                                            {!! $errors->first('kegiatan', '<p class="text-danger">:message</p>') !!}
                                    </div>
                                </div>

                                {{-- Unit, Metode, Jenis --}}
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="unit" class="control-label">{{ 'Unit' }}</label>
                                        <input class="form-control" name="unit" type="text" disabled id="unit"
                                            value="{{ isset($subPerencanaan->unit->nama) ? $subPerencanaan->unit->nama : old('unit') }}">
                                        {!! $errors->first('unit', '<p class="text-danger">:message</p>') !!}
                                    </div>
                                
                                    <div class="col-md-3 form-group">
                                        <label for="metode_pengadaan" class="control-label">{{ 'Metode Pengadaan' }}</label>
                                        <input class="form-control" name="metode_pengadaan" type="text" disabled id="metode_pengadaan"
                                            value="{{ isset($subPerencanaan->metodePengadaan->nama_metode) ? $subPerencanaan->metodePengadaan->nama_metode : old('metodePengadaan') }}">
                                        {!! $errors->first('metodePengadaan', '<p class="text-danger">:message</p>') !!}
                                    </div>
                                
                                    <div class="col-md-3 form-group">
                                        <label for="jenis_pengadaan" class="control-label">{{ 'Jenis Pengadaan' }}</label>
                                        <input class="form-control" name="jenis_pengadaan" type="text" disabled id="jenis_pengadaan"
                                            value="{{ isset($subPerencanaan->jenisPengadaan->nama_jenis) ? $subPerencanaan->jenisPengadaan->nama_jenis : old('jenisPengadaan') }}">
                                        {!! $errors->first('jenisPengadaan', '<p class="text-danger">:message</p>') !!}
                                    </div>
                                </div>                                

                                <!-- Upload Dokumen Pemilihan Penyedia -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="dokumen_pemilihan_penyedia" class="col-sm-4 col-form-label">{{ __('Dokumen Pemilihan Penyedia') }}</label>
                                            <div class="col-sm-8">
                                                <input type="file" name="dokumen_pemilihan_penyedia" class="form-control-file" id="dokumen_pemilihan_penyedia">
                                                <small class="form-text text-muted">*Format PDF dengan maksimal ukuran file 10 MB</small>
                                                
                                                @if (isset($pengadaan->dokumen_pemilihan_penyedia))
                                                    <p class="mt-2">Dokumen sudah ada: 
                                                        <a href="{{ Storage::url($pengadaan->dokumen_pemilihan_penyedia) }}" target="_blank" class="btn btn-link">Lihat Dokumen</a>
                                                    </p>
                                                    <input type="hidden" name="existing_dokumen_pemilihan_penyedia" value="{{ $pengadaan->dokumen_pemilihan_penyedia }}">
                                                @endif
                                
                                                @if ($errors->has('dokumen_pemilihan_penyedia'))
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('dokumen_pemilihan_penyedia') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Catatan -->
                                {{-- <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Catatan</label>
                                            <div class="col-sm-8">
                                                @if (
                                                    $subPerencanaan->pengadaan &&
                                                    $subPerencanaan->pengadaan->status &&
                                                    $subPerencanaan->pengadaan->status->nama_status == 'Pemenuhan Dokumen'
                                                )
                                                    <div class="alert alert-info">
                                                        {{ $subPerencanaan->pengadaan->catatan ?? 'Belum ada catatan' }}
                                                    </div>
                                                @else
                                                    <div class="alert alert-secondary">
                                                        Belum ada catatan
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="button" class="btn btn-warning" onclick="history.back();">
                                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                                    </button>&nbsp;
                                    <button type="submit" class="btn btn-success">
                                        {{ 'Simpan' }}
                                    </button>
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
