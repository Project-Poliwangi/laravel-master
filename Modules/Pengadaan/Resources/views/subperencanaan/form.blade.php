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
                                    {{-- Fields for subPerencanaan --}}
                                    {{-- Akun Belanja dan Unit --}}
                                    <div class="col-md-6 form-group">
                                        <label for="akun_belanja" class="control-label">{{ 'Akun Belanja' }}</label>
                                        <select name="perencanaan_id" class="form-control" id="perencanaan_id" required>
                                            <option value="">--- Pilih Akun Belanja ---</option>
                                            <!-- Tambahkan opsi default jika diperlukan -->
                                            @foreach ($perencanaans as $perencanaan)
                                                <option value="{{ $perencanaan->id }}"
                                                    {{ isset($subperencanaan) && $subperencanaan->perencanaan_id == $perencanaan->id ? 'selected' : '' }}>
                                                    {{ $perencanaan->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('akun belanja', '<p class="help-block">:message</p>') !!}
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="kegiatan" class="control-label">{{ 'Unit' }}</label>
                                        <select class="form-control" id="unit_id" name="unit_id" required>
                                            <option value="">--- Pilih Unit/Jurusan/Pusat ---</option>
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}"
                                                    {{ isset($subperencanaan) && $subperencanaan->unit_id == $unit->id ? 'selected' : '' }}>
                                                    {{ $unit->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('unit_id', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                {{-- Kegiatan dan Output --}}
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="kegiatan" class="control-label">{{ 'Kegiatan' }}</label>
                                        <input class="form-control" name="kegiatan" type="text" id="kegiatan"
                                            required
                                            value="{{ isset($subperencanaan->kegiatan) ? $subperencanaan->kegiatan : old('kegiatan') }}">
                                        {!! $errors->first('kegiatan', '<p class="help-block">:message</p>') !!}
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="output" class="control-label">{{ 'Output' }}</label>
                                        <input class="form-control" name="output" type="text" id="output"
                                            required
                                            value="{{ isset($subperencanaan->output) ? $subperencanaan->output : old('output') }}">
                                        {!! $errors->first('output', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                <!-- Satuan Volume Harga Satuan -->
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="satuan" class="control-label">{{ 'Satuan' }}</label>
                                        <input class="form-control" name="satuan" type="text" id="satuan"
                                            required
                                            value="{{ isset($subperencanaan->satuan) ? $subperencanaan->satuan : old('satuan') }}">
                                        {!! $errors->first('satuan', '<p class="help-block">:message</p>') !!}
                                    </div>


                                    <div class="col-md-4 form-group">
                                        <label for="volume" class="control-label">{{ 'Volume' }}</label>
                                        <input class="form-control" name="volume" type="number" id="volume"
                                            required
                                            value="{{ isset($subperencanaan->volume) ? $subperencanaan->volume : old('volume') }}">
                                        {!! $errors->first('volume', '<p class="help-block">:message</p>') !!}
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="harga_satuan" class="control-label">{{ 'Harga Satuan' }}</label>
                                        <input class="form-control" name="harga_satuan" type="number" id="harga_satuan"
                                            required
                                            value="{{ isset($subperencanaan->harga_satuan) ? $subperencanaan->harga_satuan : old('harga_satuan') }}">
                                        {!! $errors->first('harga_satuan', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                {{-- Rencana Mulai dan Rencana Bayar --}}
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="rencana_mulai" class="control-label">{{ 'Rencana Mulai' }}</label>
                                        <input class="form-control" name="rencana_mulai" type="date"
                                            id="rencana_mulai" required
                                            value="{{ isset($subperencanaan->rencana_mulai) ? $subperencanaan->rencana_mulai : old('rencana_mulai') }}">
                                        {!! $errors->first('rencana mulai', '<p class="help-block">:message</p>') !!}
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="rencana_bayar" class="control-label">{{ 'Rencana Bayar' }}</label>
                                        <input class="form-control" name="rencana_bayar" type="date"
                                            id="rencana_bayar" required required
                                            value="{{ isset($subperencanaan->rencana_bayar) ? $subperencanaan->rencana_bayar : old('rencana_bayar') }}">
                                        {!! $errors->first('rencana bayar', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                {{-- Jenis Pengadaan dan PPK --}}
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="ppk"
                                            class="control-label">{{ 'Pejabat Pembuat Komitmen (PPK)' }}</label>
                                        <select class="form-control" id="ppk_id" name="ppk_id" required>
                                            <option value="">--- Pilih Pejabat Pembuat Komitmen ---</option>
                                            @foreach ($ppk as $ppks)
                                                <option value="{{ $ppks->id }}"
                                                    {{ isset($subperencanaan) && $subperencanaan->ppk_id == $ppks->id ? 'selected' : '' }}>
                                                    {{ $ppks->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('pejabat pembuat komitmen', '<p class="help-block">:message</p>') !!}
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="jenis_pengadaan"
                                            class="control-label">{{ 'Jenis Pengadaan' }}</label>
                                        <select class="form-control" id="jenis_pengadaan_id" name="jenis_pengadaan_id"
                                            required>
                                            <option value="">--- Pilih Jenis Pengadaan ---</option>
                                            @foreach ($jenispengadaans as $jenis)
                                                <option value="{{ $jenis->id }}"
                                                    {{ isset($subperencanaan) && $subperencanaan->jenis_pengadaan_id == $jenis->id ? 'selected' : '' }}>
                                                    {{ $jenis->nama_jenis }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('jenis pengadaan', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                {{-- Submit Button --}}
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
