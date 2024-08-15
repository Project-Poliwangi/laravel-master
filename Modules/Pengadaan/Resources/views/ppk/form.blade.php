<!-- Basic Horizontal form layout section start -->
<section id="basic-horizontal-layouts">
    <div class="row match-height">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-horizontal">
                            <div class="form-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="kode" class="control-label">{{ 'Kode' }}</label>
                                                <div class="form-control-plaintext bg-light border rounded px-2 py-1"
                                                    id="kode">
                                                    {{ $subPerencanaan->perencanaan->kode ?? old('kode') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="sumber" class="control-label">{{ 'Sumber' }}</label>
                                                <div class="form-control-plaintext bg-light border rounded px-2 py-1"
                                                    id="sumber">
                                                    {{ $subPerencanaan->perencanaan->sumber ?? old('sumber') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="perencanaan_id"
                                                    class="control-label">{{ 'Perencanaan' }}</label>
                                                <div class="form-control-plaintext bg-light border rounded px-2 py-1"
                                                    id="perencanaan_id">
                                                    {{ $subPerencanaan->perencanaan->nama ?? old('perencanaan') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="jenis_pengadaaan_id"
                                                    class="control-label">{{ 'Jenis Pengadaan' }}</label>
                                                <div class="form-control-plaintext bg-light border rounded px-2 py-1"
                                                    id="jenis_pengadaaan_id">
                                                    {{ $subPerencanaan->jenisPengadaan->nama_jenis ?? old('jenis_pengadaan') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="kegiatan" class="control-label">{{ 'Kegiatan' }}</label>
                                                <div class="form-control-plaintext bg-light border rounded px-2 py-1"
                                                    id="kegiatan">
                                                    {{ $subPerencanaan->kegiatan ?? old('kegiatan') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="volume"
                                                    class="control-label">{{ 'Volume dan Satuan' }}</label>
                                                <div class="input-group">
                                                    <input class="form-control" name="volume" type="number"
                                                        id="volume" required min="0"
                                                        value="{{ isset($subPerencanaan->volume) ? $subPerencanaan->volume : old('volume') }}"
                                                        oninput="updatePagu()" {{ $disabled }}>
                                                    <input class="form-control" name="satuan" type="text"
                                                        id="satuan" required
                                                        value="{{ isset($subPerencanaan->satuan) ? $subPerencanaan->satuan : old('satuan') }}" {{ $disabled }}>
                                                </div>
                                                {!! $errors->first('volume', '<p class="text-danger">:message</p>') !!}
                                                {!! $errors->first('satuan', '<p class="text-danger">:message</p>') !!}
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="harga_satuan"
                                                    class="control-label">{{ 'Harga Satuan' }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp.</span>
                                                    </div>
                                                    <input class="form-control" name="harga_satuan" type="text"
                                                        id="harga_satuan" required
                                                        value="{{ isset($subPerencanaan->harga_satuan) ? number_format($subPerencanaan->harga_satuan, 0, ',', '.') : old('harga_satuan') }}" {{ $disabled }}>
                                                </div>
                                                {!! $errors->first('harga_satuan', '<p class="text-danger">:message</p>') !!}
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="pagu" class="control-label">{{ 'Pagu' }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp.</span>
                                                    </div>
                                                    <input class="form-control" name="pagu" type="text"
                                                        id="pagu" required readonly
                                                        value="{{ isset($subPerencanaan->pagu) ? number_format($subPerencanaan->pagu, 0, ',', '.') : old('pagu') }}" {{ $disabled }}>
                                                </div>
                                                {!! $errors->first('pagu', '<p class="text-danger">:message</p>') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="rencana_mulai"
                                                    class="control-label">{{ 'Rencana Mulai' }}</label>
                                                <input class="form-control" name="rencana_mulai" type="date"
                                                    id="rencana_mulai" required
                                                    value="{{ isset($subPerencanaan->rencana_mulai) ? $subPerencanaan->rencana_mulai : old('rencana_mulai') }}" {{ $disabled }}>
                                                {!! $errors->first('rencana_mulai', '<p class="text-danger">:message</p>') !!}
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="rencana_bayar"
                                                    class="control-label">{{ 'Rencana Bayar' }}</label>
                                                <input class="form-control" name="rencana_bayar" type="date"
                                                    id="rencana_bayar"
                                                    value="{{ isset($subPerencanaan->rencana_bayar) ? $subPerencanaan->rencana_bayar : old('rencana_bayar') }}" {{ $disabled }}>
                                                {!! $errors->first('rencana_bayar', '<p class="text-danger">:message</p>') !!}
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="metode"
                                                    class="control-label">{{ 'Metode Pengadaan' }}</label>
                                                <select class="form-control" id="metode_pengadaan_id"
                                                    name="metode_pengadaan_id" required {{ $disabled }}>
                                                    <option value="" disabled
                                                        {{ old('metode_pengadaan_id', isset($subPerencanaan->metode_pengadaan_id) ? $subPerencanaan->metode_pengadaan_id : '') == '' ? 'selected' : '' }}>
                                                        --- Pilih Metode ---
                                                    </option>
                                                    @foreach ($metodePengadaan as $metode)
                                                        <option value="{{ $metode->id }}"
                                                            {{ isset($subPerencanaan) && $subPerencanaan->metode_pengadaan_id == $metode->id ? 'selected' : '' }}>
                                                            {{ $metode->nama_metode }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                {!! $errors->first('metode_pengadaan', '<p class="text-danger">:message</p>') !!}
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="pp_id"
                                                    class="control-label">{{ 'Pejabat Pengadaan (PP)' }}</label>
                                                <select name="pp_id" class="form-control" id="pp_id" required {{ $disabled }}>
                                                    <option value="">Pilih PP</option>
                                                    @foreach ($pp as $pps)
                                                        <option value="{{ $pps->id }}"
                                                            {{ isset($subPerencanaan) && $subPerencanaan->pp_id == $pps->id ? 'selected' : '' }} {{ $disabled }}>
                                                            {{ $pps->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                {!! $errors->first('pp_id', '<p class="text-danger">:message</p>') !!}
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Output dan Catatan --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="output"
                                                    class="control-label">{{ 'Output' }}</label>
                                                <textarea class="form-control" name="output" id="output" rows="3" {{ $disabled }}>{{ isset($subPerencanaan->output) ? $subPerencanaan->output : old('output') }}</textarea>
                                                {!! $errors->first('output', '<p class="text-danger">:message</p>') !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="catatan" class="control-label">{{ 'Catatan' }}</label>
                                            @if (isset($pengadaan) && isset($pengadaan->status) && $pengadaan->status->nama_status == 'Pemenuhan Dokumen')
                                                <textarea id="catatan" name="catatan" rows="3" class="form-control"
                                                    placeholder="Tulis catatan jika dokumen belum terpenuhi...">{{ old('catatan', $pengadaan->catatan) }}</textarea>
                                                <small class="form-text text-muted">Catatan ini hanya akan dapat ditambahkan
                                                    ketika status
                                                    pengadaan adalah "Pemenuhan Dokumen".</small>
                                            @else
                                                <textarea id="catatan" name="catatan" rows="3" class="form-control" disabled
                                                    placeholder="Catatan tidak tersedia untuk status ini.">{{ old('catatan', isset($pengadaan) ? $pengadaan->catatan : '') }}</textarea>
                                                <small class="form-text text-muted">Catatan hanya dapat ditambahkan
                                                    ketika status
                                                    pengadaan adalah "Pemenuhan Dokumen".</small>
                                            @endif
                                            {!! $errors->first('catatan', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    {{-- Fields for Pengadaan documents --}}
                                    {{-- Dokumen KAK dan Dokumen HPS --}}
                                    <div class="container">
                                        <div class="card mb-3">
                                            <div class="card-header bg-primary text-white">
                                                <i class="fa fa-file-alt"></i> Dokumen Pengadaan
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    {{-- Dokumen KAK --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label
                                                                class="col-sm-6 col-form-label">{{ 'Dokumen KAK' }}</label>
                                                            <div class="col-sm-6">
                                                                @if (isset($pengadaan->dokumen_kak))
                                                                    <a href="{{ asset('storage/' . $pengadaan->dokumen_kak) }}"
                                                                        target="_blank"
                                                                        class="btn btn-outline-primary btn-sm">
                                                                        <i class="fa fa-download"></i> Lihat Dokumen
                                                                    </a>
                                                                @else
                                                                    <span class="badge badge-warning"><i
                                                                            class="fa fa-exclamation-circle"></i>
                                                                        Dokumen belum
                                                                        tersedia</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- Dokumen HPS --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label
                                                                class="col-sm-6 col-form-label">{{ 'Dokumen HPS' }}</label>
                                                            <div class="col-sm-6">
                                                                @if (isset($pengadaan->dokumen_hps))
                                                                    <a href="{{ asset('storage/' . $pengadaan->dokumen_hps) }}"
                                                                        target="_blank"
                                                                        class="btn btn-outline-primary btn-sm">
                                                                        <i class="fa fa-download"></i> Lihat Dokumen
                                                                    </a>
                                                                @else
                                                                    <span class="badge badge-warning"><i
                                                                            class="fa fa-exclamation-circle"></i>
                                                                        Dokumen belum
                                                                        tersedia</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Dokumen Stock Opname dan Dokumen Surat Ijin Impor --}}
                                                <div class="row">
                                                    {{-- Dokumen Stock Opname --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label
                                                                class="col-sm-6 col-form-label">{{ 'Dokumen Stock Opname' }}</label>
                                                            <div class="col-sm-6">
                                                                @if (isset($pengadaan->dokumen_stock_opname))
                                                                    <a href="{{ asset('storage/' . $pengadaan->dokumen_stock_opname) }}"
                                                                        target="_blank"
                                                                        class="btn btn-outline-primary btn-sm">
                                                                        <i class="fa fa-download"></i> Lihat Dokumen
                                                                    </a>
                                                                @else
                                                                    <span class="badge badge-warning"><i
                                                                            class="fa fa-exclamation-circle"></i>
                                                                        Dokumen belum
                                                                        tersedia</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- Dokumen Surat Ijin Impor --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label
                                                                class="col-sm-6 col-form-label">{{ 'Dokumen Surat Ijin Impor' }}</label>
                                                            <div class="col-sm-6">
                                                                @if (isset($pengadaan->dokumen_surat_ijin_impor))
                                                                    <a href="{{ asset('storage/' . $pengadaan->dokumen_surat_ijin_impor) }}"
                                                                        target="_blank"
                                                                        class="btn btn-outline-primary btn-sm">
                                                                        <i class="fa fa-download"></i> Lihat Dokumen
                                                                    </a>
                                                                @else
                                                                    <span class="badge badge-warning"><i
                                                                            class="fa fa-exclamation-circle"></i>
                                                                        Dokumen belum
                                                                        tersedia</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Dokumen Kontrak dan Serah Terima --}}
                                                <div class="row">
                                                    {{-- Dokumen Kontrak --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label
                                                                class="col-sm-6 col-form-label">{{ 'Dokumen Kontrak' }}</label>
                                                            <div class="col-sm-6">
                                                                <input type="file" name="dokumen_kontrak"
                                                                    class="form-control-file" id="dokumen_kontrak">
                                                                <small class="form-text text-muted">*Format PDF,
                                                                    maksimal 10 MB</small>
                                                                @if (isset($pengadaan->dokumen_kontrak))
                                                                    <p class="mt-2">Dokumen sudah ada:
                                                                        <a href="{{ asset('storage/' . $pengadaan->dokumen_kontrak) }}"
                                                                            target="_blank" class="btn btn-link"><i
                                                                                class="fa fa-download"></i> Lihat
                                                                            Dokumen</a>
                                                                    </p>
                                                                    <input type="hidden"
                                                                        name="existing_dokumen_kontrak"
                                                                        value="{{ $pengadaan->dokumen_kontrak }}">
                                                                @endif
                                                                @if ($errors->has('dokumen_kontrak'))
                                                                    <p class="text-danger">
                                                                        {{ $errors->first('dokumen_kontrak') }}</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- Dokumen Serah Terima --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label
                                                                class="col-sm-6 col-form-label">{{ 'Dokumen Serah Terima' }}</label>
                                                            <div class="col-sm-6">
                                                                <input type="file" name="dokumen_serah_terima"
                                                                    class="form-control-file"
                                                                    id="dokumen_serah_terima">
                                                                <small class="form-text text-muted">*Format PDF,
                                                                    maksimal 10 MB</small>
                                                                @if (isset($pengadaan->dokumen_serah_terima))
                                                                    <p class="mt-2">Dokumen sudah ada:
                                                                        <a href="{{ asset('storage/' . $pengadaan->dokumen_serah_terima) }}"
                                                                            target="_blank" class="btn btn-link"><i
                                                                                class="fa fa-download"></i> Lihat
                                                                            Dokumen</a>
                                                                    </p>
                                                                    <input type="hidden"
                                                                        name="existing_dokumen_serah_terima"
                                                                        value="{{ $pengadaan->dokumen_serah_terima }}">
                                                                @endif
                                                                @if ($errors->has('dokumen_serah_terima'))
                                                                    <p class="text-danger">
                                                                        {{ $errors->first('dokumen_serah_terima') }}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- // Basic Horizontal form layout section end -->

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
