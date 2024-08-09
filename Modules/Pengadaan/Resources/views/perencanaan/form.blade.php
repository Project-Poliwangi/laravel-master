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
                                <div class="col-md-4">
                                    <label for="nama" class="control-label">{{ 'Nama' }}</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input class="form-control" name="nama" type="text" id="nama" required
                                        value="{{ isset($perencanaans->nama) ? $perencanaans->nama : old('nama') }}">
                                </div>

                                {{-- Kode --}}
                                <div class="col-md-4">
                                    <label for="kode" class="control-label">{{ 'Kode' }}</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input class="form-control" name="kode" type="text" id="kode" required
                                        value="{{ isset($perencanaans->kode) ? $perencanaans->kode : old('kode') }}">
                                </div>

                                {{-- Sumber --}}
                                <div class="col-md-4">
                                    <label for="sumber" class="control-label">{{ 'Sumber' }}</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <select name="sumber" id="sumber" required class="form-control"> 
                                        <option value="" disabled selected>--- Pilih Sumber Pengadaan ---
                                        </option>
                                        <option value="RM"
                                            {{ isset($perencanaans->sumber) ? ($perencanaans->sumber == 'RM' ? 'selected' : '') : (old('sumber') == 'RM' ? 'selected' : '') }}>
                                            RM</option>
                                        <option value="Hibah"
                                            {{ isset($perencanaans->sumber) ? ($perencanaans->sumber == 'Hibah' ? 'selected' : '') : (old('sumber') == 'Hibah' ? 'selected' : '') }}>
                                            Hibah</option>
                                        <option value="BOPTN"
                                            {{ isset($perencanaans->sumber) ? ($perencanaans->sumber == 'BOPTN' ? 'selected' : '') : (old('sumber') == 'BOPTN' ? 'selected' : '') }}>
                                            BOPTN</option>
                                        <option value="PNBP"
                                            {{ isset($perencanaans->sumber) ? ($perencanaans->sumber == 'PNBP' ? 'selected' : '') : (old('sumber') == 'PNBP' ? 'selected' : '') }}>
                                            PNBP</option>
                                        <option value="CF"
                                            {{ isset($perencanaans->sumber) ? ($perencanaans->sumber == 'CF' ? 'selected' : '') : (old('sumber') == 'CF' ? 'selected' : '') }}>
                                            CF</option>
                                        <option value="PML"
                                            {{ isset($perencanaans->sumber) ? ($perencanaans->sumber == 'PML' ? 'selected' : '') : (old('sumber') == 'PML' ? 'selected' : '') }}>
                                            PML</option>
                                    </select>
                                </div>

                                {{-- Pagu --}}
                                <div class="col-md-4">
                                    <label for="pagu" class="control-label">{{ 'Pagu' }}</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input class="form-control" name="pagu" type="number" id="pagu" required
                                        value="{{ isset($perencanaans->pagu) ? $perencanaans->pagu : old('pagu') }}">
                                </div>

                                {{-- Revisi --}}
                                <div class="col-md-4">
                                    <label for="revisi" class="control-label">{{ 'Revisi' }}</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input class="form-control" name="revisi" type="number" id="revisi" required
                                        value="{{ isset($perencanaans->revisi) ? $perencanaans->revisi : old('revisi') }}">
                                </div>

                                {{-- Tahun --}}
                                <div class="col-md-4">
                                    <label for="tahun" class="control-label">{{ 'Tahun' }}</label>
                                </div>
                                <div class="col-md-8 form-group {{ $errors->has('tahun') ? 'has-error' : '' }}">
                                    <input class="form-control" name="tahun" type="number" id="tahun"
                                        value="{{ isset($perencanaans->tahun) ? $perencanaans->tahun : old('tahun') }}">
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
