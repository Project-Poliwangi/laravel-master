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
                                    {{-- Perencanaan dan Unit --}}
                                    <div class="col-md-6 form-group">
                                        <label for="perencanaan" class="control-label">{{ 'Perencanaan' }}</label>
                                        <select name="perencanaan_id" class="form-control" id="perencanaan_id" required>
                                            <option value="" disabled selected>--- Pilih Perencanaan ---</option>
                                            <!-- Tambahkan opsi default jika diperlukan -->
                                            @foreach ($perencanaan as $perencanaans)
                                                <option value="{{ $perencanaans->id }}"
                                                    {{ isset($subPerencanaan) && $subPerencanaan->perencanaan_id == $perencanaans->id ? 'selected' : '' }}>
                                                    {{ $perencanaans->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('perencanaan', '<p class="help-block">:message</p>') !!}
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="kegiatan" class="control-label">{{ 'Unit' }}</label>
                                        <select class="form-control" id="unit_id" name="unit_id" required>
                                            <option value="" disabled selected>--- Pilih Unit/Jurusan/Pusat ---
                                            </option>
                                            @foreach ($unit as $units)
                                                <option value="{{ $units->id }}"
                                                    {{ isset($subPerencanaan) && $subPerencanaan->unit_id == $units->id ? 'selected' : '' }}>
                                                    {{ $units->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('unit_id', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                {{-- Kegiatan dan Output --}}
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="kegiatan" class="control-label">{{ 'Kegiatan' }}</label>
                                        <input class="form-control" name="kegiatan" type="text" id="kegiatan"
                                            required
                                            value="{{ isset($subPerencanaan->kegiatan) ? $subPerencanaan->kegiatan : old('kegiatan') }}">
                                        {!! $errors->first('kegiatan', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                <!-- Satuan Volume Harga Satuan -->
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label class="control-label">{{ 'Volume dan Satuan' }}</label>
                                        <div class="input-group">
                                            <!-- Label untuk Volume -->
                                            <input class="form-control" name="volume" type="number" id="volume"
                                                required
                                                value="{{ isset($subPerencanaan->volume) ? $subPerencanaan->volume : old('volume') }}"
                                                oninput="updatePagu()">

                                            <!-- Label untuk Satuan -->
                                            <input class="form-control" name="satuan" type="text" id="satuan"
                                                required
                                                value="{{ isset($subPerencanaan->satuan) ? $subPerencanaan->satuan : old('satuan') }}">
                                        </div>
                                        {!! $errors->first('volume', '<p class="help-block">:message</p>') !!}
                                        {!! $errors->first('satuan', '<p class="help-block">:message</p>') !!}
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="harga_satuan" class="control-label">{{ 'Harga Satuan' }}</label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input class="form-control" name="harga_satuan" type="text"
                                                id="harga_satuan" required
                                                value="{{ isset($subPerencanaan->harga_satuan) ? number_format($subPerencanaan->harga_satuan, 0, ',', '.') : old('harga_satuan') }}">
                                        </div>
                                        {!! $errors->first('harga_satuan', '<p class="help-block">:message</p>') !!}
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="pagu" class="control-label">{{ 'Pagu' }}</label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input class="form-control" name="pagu" type="text" id="pagu"
                                                required readonly
                                                value="{{ isset($subPerencanaan->pagu) ? number_format($subPerencanaan->pagu, 0, ',', '.') : old('pagu') }}">
                                        </div>
                                        {!! $errors->first('pagu', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                

                                {{-- Rencana Mulai dan Rencana Bayar --}}
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="rencana_mulai" class="control-label">{{ 'Rencana Mulai' }}</label>
                                        <input class="form-control" name="rencana_mulai" type="date"
                                            id="rencana_mulai" required
                                            value="{{ isset($subPerencanaan->rencana_mulai) ? $subPerencanaan->rencana_mulai : old('rencana_mulai') }}">
                                        {!! $errors->first('rencana mulai', '<p class="help-block">:message</p>') !!}
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="rencana_bayar" class="control-label">{{ 'Rencana Bayar' }}</label>
                                        <input class="form-control" name="rencana_bayar" type="date"
                                            id="rencana_bayar" required required
                                            value="{{ isset($subPerencanaan->rencana_bayar) ? $subPerencanaan->rencana_bayar : old('rencana_bayar') }}">
                                        {!! $errors->first('rencana bayar', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                {{-- Jenis Pengadaan --}}
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="jenis_pengadaan"
                                            class="control-label">{{ 'Jenis Pengadaan' }}</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <select class="form-control" id="jenis_pengadaan_id" name="jenis_pengadaan_id"
                                            required>
                                            <option value="" disabled selected>--- Pilih Jenis Pengadaan ---
                                            </option>
                                            @foreach ($jenisPengadaan as $jenis)
                                                <option value="{{ $jenis->id }}"
                                                    {{ isset($subPerencanaan) && $subPerencanaan->jenis_pengadaan_id == $jenis->id ? 'selected' : '' }}>
                                                    {{ $jenis->nama_jenis }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('jenis pengadaan', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                {{-- Output --}}
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="output" class="control-label">{{ 'Output' }}</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input class="form-control" name="output" type="text" id="output"
                                            required
                                            value="{{ isset($subPerencanaan->output) ? $subPerencanaan->output : old('output') }}">
                                        {!! $errors->first('output', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                {{-- PPK --}}
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="ppk"
                                            class="control-label">{{ 'Pejabat Pembuat Komitmen' }}</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <select class="form-control" id="ppk_id" name="ppk_id" required>
                                            <option value="" disabled selected>--- Pilih Pejabat Pembuat Komitmen
                                                (PPK) ---</option>
                                            @foreach ($ppk as $ppks)
                                                <option value="{{ $ppks->id }}"
                                                    {{ isset($subPerencanaan) && $subPerencanaan->ppk_id == $ppks->id ? 'selected' : '' }}>
                                                    {{ $ppks->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('ppk_id', '<p class="help-block">:message</p>') !!}
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

<script>
    function updatePagu() {
        var volume = parseFloat(document.getElementById('volume').value.replace(/\D/g, '')) || 0;
        var hargaSatuan = parseFloat(removeFormatting(document.getElementById('harga_satuan').value)) || 0;
        var pagu = volume * hargaSatuan;

        document.getElementById('pagu').value = formatCurrency(pagu);
    }

    function formatCurrency(value) {
        return new Intl.NumberFormat('id-ID', {
            style: 'decimal',
            minimumFractionDigits: 0,
        }).format(value);
    }

    function removeFormatting(value) {
        return value.replace(/[^0-9]/g, ''); // Menghapus semua karakter non-numerik
    }

    document.getElementById('harga_satuan').addEventListener('input', function(e) {
        var value = e.target.value.replace(/\D/g, ''); // Menghapus semua karakter selain digit
        e.target.value = formatCurrency(value);
        updatePagu(); // Perbarui Pagu setiap kali harga_satuan berubah
    });

    document.getElementById('volume').addEventListener('input', function() {
        updatePagu(); // Perbarui Pagu setiap kali volume berubah
    });

    document.getElementById('harga_satuan').addEventListener('blur', function() {
        this.value = formatCurrency(removeFormatting(this.value));
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Menyegarkan harga_satuan dan pagu saat halaman dimuat
        updatePagu();
    });
</script>


<!-- // Basic Horizontal form layout section end -->
