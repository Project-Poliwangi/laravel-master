<input type="hidden" name="backurl" value="<?php echo (Request::server('HTTP_REFERER')==null?'/monitoring/realisasi':Request::server('HTTP_REFERER')); ?>">

<div class="form-group">
    <label for="program" class="control-label">Progres</label>
    <input class="form-control" name="progres" type="text" id="progres" value="progres" required>
</div>

<div class="form-group">
    <label for="realisasi" class="control-label">Realisasi</label>
    <input class="form-control" name="realisasi" type="number" id="realisasi" value="realisasi" required>
</div>

<div class="form-group>
    <label for="laporan_keuangan" class="control-label">Laporan Keuangan</label>
    <input class="form-control" name="laporan_keuangan" type="number" id="laporan_keuangan" value="laporan_keuangan" required>
</div>

<div class="form-group">
    <label for="realisasi" class="control-label">Realisasi</label>
    <input class="form-control" name="realisasi" type="number" id="realisasi" value="realisasi" required>
</div>

<div class="form-group">
    <label for="realisasi" class="control-label">Realisasi</label>
    <input class="form-control" name="realisasi" type="number" id="realisasi" value="realisasi" required>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Memperbarui' : 'Tambah' }}">
</div>