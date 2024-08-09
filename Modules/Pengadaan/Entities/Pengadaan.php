<?php

namespace Modules\Pengadaan\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    use HasFactory;

    protected $table = 'pengadaan';
    protected $primary = 'id';

    protected $fillable = [
        'catatan',
        'dokumen_kak',
        'dokumen_hps',
        'dokumen_stock_opname',
        'dokumen_surat_ijin_impor',
        'status_id',
        'subperencanaan_id',
    ];

    public function status() // Renamed to 'status' for clarity
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function subperencanaan()
    {
        return $this->belongsTo(SubPerencanaan::class, 'subperencanaan_id');
    }
}
