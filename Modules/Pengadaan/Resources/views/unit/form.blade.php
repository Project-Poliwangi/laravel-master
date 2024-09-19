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
                                    <div class="col-md-12 form-group">
                                        <label for="kegiatan" class="control-label">{{ 'Kegiatan' }}</label>
                                        <input class="form-control" name="kegiatan" type="text" disabled
                                            id="kegiatan"
                                            value="{{ isset($subPerencanaan->kegiatan) ? $subPerencanaan->kegiatan : old('kegiatan') }}">
                                        {!! $errors->first('kegiatan', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                {{-- Volume Satuan Harga Satuan Pagu --}}
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label class="control-label">{{ 'Volume dan Satuan' }}</label>
                                        <div class="input-group">
                                            <!-- Label untuk Volume -->
                                            <input class="form-control" name="volume" type="number" id="volume"
                                                required min="0"
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

                                <!-- Output -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="output" class="form-label">{{ 'Output' }}</label>
                                            <textarea class="form-control" name="output" id="output" rows="3">{{ isset($subPerencanaan->output) ? $subPerencanaan->output : old('output') }}</textarea>
                                            {!! $errors->first('output', '<p class="text-danger">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>

                                <!-- Rencana Mulai and Rencana Bayar dan PIC -->
                                <div class="row mb-3">
                                    <div class="col-md-3 form-group">
                                        <label for="rencana_mulai" class="control-label">{{ 'Rencana Mulai' }}</label>
                                        <input class="form-control" name="rencana_mulai" type="date"
                                            id="rencana_mulai" required
                                            value="{{ isset($subPerencanaan->rencana_mulai) ? $subPerencanaan->rencana_mulai : old('rencana_mulai') }}">
                                        {!! $errors->first('rencana mulai', '<p class="help-block">:message</p>') !!}
                                    </div>
                                
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="rencana_bayar" class="form-label">{{ 'Rencana Bayar' }}</label>
                                            @php
                                                // Dapatkan tanggal saat ini
                                                $currentDate = now();
                                                // Tentukan batas minimum untuk bulan ini
                                                $minDate = $currentDate->startOfMonth()->toDateString();
                                            @endphp
                                            <input class="form-control" name="rencana_bayar" type="date" id="rencana_bayar"
                                                value="{{ isset($subPerencanaan->rencana_bayar) ? $subPerencanaan->rencana_bayar : old('rencana_bayar') }}"
                                                min="{{ $minDate }}">
                                            {!! $errors->first('rencana_bayar', '<p class="text-danger">:message</p>') !!}
                                        </div>
                                    </div>                                    
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pic_id" class="form-label">{{ 'PIC' }}</label>
                                            <select name="pic_id" class="form-control" id="pic_id" required>
                                                <option value="">Pilih PIC</option>
                                                @foreach ($pics as $pic)
                                                    <option value="{{ $pic->id }}"
                                                        {{ isset($subPerencanaan) && $subPerencanaan->pic_id == $pic->id ? 'selected' : '' }}>
                                                        {{ $pic->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            {!! $errors->first('pic_id', '<p class="text-danger">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>

                                {{-- Dokumen KAK dan Dokumen HPS --}}
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="d-flex align-items-center">
                                                <label for="dokumen_kak" class="form-label mb-0">{{ 'Dokumen KAK' }}</label>
                                                <small class="form-text text-danger ml-2">*Wajib dilampirkan</small>
                                            </div>
                                            <input type="file" name="dokumen_kak" class="form-control-file" id="dokumen_kak">
                                            <small class="form-text text-muted">*Format PDF dengan maksimal ukuran file 10 MB</small>
                                            @if (isset($pengadaan->dokumen_kak))
                                                <p class="mt-2">Dokumen KAK sudah ada:
                                                    <a href="{{ asset('storage/dokumen_kak/' . $pengadaan->dokumen_kak) }}" target="_blank" class="btn btn-link">Lihat Dokumen</a>
                                                </p>
                                                <input type="hidden" name="existing_dokumen_kak" value="{{ $pengadaan->dokumen_kak }}">
                                            @endif
                                            @if ($errors->has('dokumen_kak'))
                                                <p class="text-danger">{{ $errors->first('dokumen_kak') }}</p>
                                            @endif
                                        </div>
                                    </div>                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dokumen_hps" class="form-label">{{ 'Dokumen HPS' }}</label>
                                            <input type="file" name="dokumen_hps" class="form-control-file"
                                                id="dokumen_hps">
                                            <small class="form-text text-muted">*Format PDF dengan maksimal ukuran file
                                                10 MB</small>
                                            @if (isset($pengadaan->dokumen_hps))
                                                <p class="mt-2">Dokumen HPS sudah ada:
                                                    <a href="{{ asset('storage/dokumen_hps/' . $pengadaan->dokumen_hps) }}"
                                                        target="_blank" class="btn btn-link">Lihat Dokumen</a>
                                                </p>
                                                <input type="hidden" name="existing_dokumen_hps"
                                                    value="{{ $pengadaan->dokumen_hps }}">
                                            @endif
                                            @if ($errors->has('dokumen_hps'))
                                                <p class="text-danger">{{ $errors->first('dokumen_hps') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- Dokumen Stock Opname dan Dokumen Surat Ijin Impor --}}
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dokumen_stock_opname"
                                                class="form-label">{{ 'Dokumen Stock Opname' }}</label>
                                            <input type="file" name="dokumen_stock_opname"
                                                class="form-control-file" id="dokumen_stock_opname">
                                            <small class="form-text text-muted">*Format PDF dengan maksimal ukuran file
                                                10 MB</small>
                                            @if (isset($pengadaan->dokumen_stock_opname))
                                                <p class="mt-2">Dokumen Stock Opname sudah ada:
                                                    <a href="{{ asset('storage/dokumen_stock_opname/' . $pengadaan->dokumen_stock_opname) }}"
                                                        target="_blank" class="btn btn-link">Lihat Dokumen</a>
                                                </p>
                                                <input type="hidden" name="existing_dokumen_stock_opname"
                                                    value="{{ $pengadaan->dokumen_stock_opname }}">
                                            @endif
                                            @if ($errors->has('dokumen_stock_opname'))
                                                <p class="text-danger">{{ $errors->first('dokumen_stock_opname') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dokumen_surat_ijin_impor"
                                                class="form-label">{{ 'Dokumen Surat Ijin Impor' }}</label>
                                            <input type="file" name="dokumen_surat_ijin_impor"
                                                class="form-control-file" id="dokumen_surat_ijin_impor">
                                            <small class="form-text text-muted">*Format PDF dengan maksimal ukuran file
                                                10 MB</small>
                                            @if (isset($pengadaan->dokumen_surat_ijin_impor))
                                                <p class="mt-2">Dokumen Surat Ijin Impor sudah ada:
                                                    <a href="{{ asset('storage/dokumen_surat_ijin_impor/' . $pengadaan->dokumen_surat_ijin_impor) }}"
                                                        target="_blank" class="btn btn-link">Lihat Dokumen</a>
                                                </p>
                                                <input type="hidden" name="existing_dokumen_surat_ijin_impor"
                                                    value="{{ $pengadaan->dokumen_surat_ijin_impor }}">
                                            @endif
                                            @if ($errors->has('dokumen_surat_ijin_impor'))
                                                <p class="text-danger">
                                                    {{ $errors->first('dokumen_surat_ijin_impor') }}</p>
                                            @endif
                                        </div>
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
                            </div>
                        </form>
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
