<?php

namespace Modules\Monitoring\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubPerencanaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kegiatan',
        'satuan',
        'volume',
        'harga_satuan',
        'output',
        'rencana_mulai',
        'rencana_bayar',
        'file_hps',
        'file_kak',
        'pic_id',
        'ppk_id',
        'perencanaan_id'
    ];

    public function perencanaan()
    {
        return $this->belongsTo('Modules\Monitoring\Entities\Perencanaan');
    }

    public function realisasi()
    {
        return $this->hasMany('Modules\Monitoring\Entities\Realisasi');
    }
}
