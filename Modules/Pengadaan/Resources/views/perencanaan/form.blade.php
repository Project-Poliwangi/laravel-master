<!-- Basic Horizontal form layout section start -->
<section id="basic-horizontal-layouts">
    <div class="row match-height">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <form class="form form-horizontal">
                        <div class="form-body">
                            <div class="row">
                                {{-- Nama --}}
                                <div class="col-md-12 form-group">
                                    <label for="nama" class="control-label">{{ 'Nama' }}</label>
                                    <input class="form-control" name="nama" type="text" id="nama" required
                                        value="{{ isset($perencanaans->nama) ? $perencanaans->nama : old('nama') }}">
                                    {!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
                                </div>

                                {{-- Kode --}}
                                <div class="col-md-6 form-group">
                                    <label for="kode" class="control-label">{{ 'Kode' }}</label>
                                    <input class="form-control" name="kode" type="number" id="kode" required
                                        value="{{ isset($perencanaans->kode) ? $perencanaans->kode : old('kode') }}">
                                    {!! $errors->first('kode', '<p class="help-block">:message</p>') !!}
                                </div>

                                {{-- Revisi --}}
                                <div class="col-md-6 form-group">
                                    <label for="revisi" class="control-label">{{ 'Revisi' }}</label>
                                    <input class="form-control" name="revisi" type="number" id="revisi" required
                                        value="{{ isset($perencanaans->revisi) ? $perencanaans->revisi : old('revisi') }}">
                                </div>

                                {{-- Sumber --}}
                                <div class="col-md-6 form-group">
                                    <label for="sumber" class="control-label">{{ 'Sumber' }}</label>
                                    <select name="sumber" id="sumber" required class="form-control">
                                        <option value="" disabled selected>--- Pilih Sumber Pengadaan ---
                                        </option>
                                        <option value="PNP"
                                            {{ isset($perencanaans->sumber) ? ($perencanaans->sumber == 'PNP' ? 'selected' : '') : (old('sumber') == 'PNP' ? 'selected' : '') }}>
                                            PNP</option>
                                        <option value="RM"
                                            {{ isset($perencanaans->sumber) ? ($perencanaans->sumber == 'RM' ? 'selected' : '') : (old('sumber') == 'RM' ? 'selected' : '') }}>
                                            RM</option>
                                        <option value="Hibah"
                                            {{ isset($perencanaans->sumber) ? ($perencanaans->sumber == 'Hibah' ? 'selected' : '') : (old('sumber') == 'Hibah' ? 'selected' : '') }}>
                                            Hibah</option>
                                        <option value="BOPTN"
                                            {{ isset($perencanaans->sumber) ? ($perencanaans->sumber == 'BOPTN' ? 'selected' : '') : (old('sumber') == 'BOPTN' ? 'selected' : '') }}>
                                            BOPTN</option>
                                        <option value="CF"
                                            {{ isset($perencanaans->sumber) ? ($perencanaans->sumber == 'CF' ? 'selected' : '') : (old('sumber') == 'CF' ? 'selected' : '') }}>
                                            CF</option>
                                        <option value="PML"
                                            {{ isset($perencanaans->sumber) ? ($perencanaans->sumber == 'PML' ? 'selected' : '') : (old('sumber') == 'PML' ? 'selected' : '') }}>
                                            PML</option>
                                    </select>
                                    
                                </div>

                                {{-- Tahun --}}
                                <div class="col-md-6 form-group {{ $errors->has('tahun') ? 'has-error' : '' }}">
                                    <label for="tahun" class="control-label">{{ 'Tahun' }}</label>
                                    <select class="form-control" name="tahun" id="tahun" required>
                                        @for ($year = date('Y'); $year >= date('Y') - 10; $year--)
                                            <option value="{{ $year }}"
                                                {{ isset($perencanaans->tahun) && $perencanaans->tahun == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endfor
                                    </select>
                                    {!! $errors->first('tahun', '<p class="help-block">:message</p>') !!}
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- // Basic Horizontal form layout section end -->
