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
        'nomor_surat',
        'total_biaya',
        'dokumen_kak',
        'dokumen_hps',
        'dokumen_stock_opname',
        'dokumen_surat_ijin_impor',
        'status_id',
        'sub_perencanaan_id',
        'jenis_pengadaan_id',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function subPerencanaan()
    {
        return $this->belongsTo(SubPerencanaan::class, 'sub_perencanaan_id');
    }

    public function jenisPengadaan()
    {
        return $this->belongsTo(JenisPengadaan::class, 'jenis_pengadaan_id');
    }
}
