<?php

namespace Modules\Pengadaan\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    use HasFactory;

    protected $table = 'pengadaan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'catatan',
        'dokumen_kak',
        'dokumen_hps',
        'dokumen_stock_opname',
        'dokumen_surat_ijin_impor',
        'dokumen_kontrak',
        'dokumen_serah_terima',
        'subperencanaan_id',
    ];

    // Relasi ke Model SubPerencanaan
    public function subPerencanaan()
    {
        return $this->belongsTo(SubPerencanaan::class, 'subperencanaan_id');
    }
}
