<?php

namespace Modules\Pengadaan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HistoryPengadaan extends Model
{
    use HasFactory;

    protected $fillable = ['pengadaan_id', 'status_lama', 'status_baru', 'keterangan'];
    
    protected static function newFactory()
    {
        return \Modules\Pengadaan\Database\factories\HistoryPengadaanFactory::new();
    }

    public function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class, 'pengadaan_id');
    }

    public function statusLama()
    {
        return $this->belongsTo(Status::class, 'status_lama');
    }

    public function statusBaru()
    {
        return $this->belongsTo(Status::class, 'status_baru');
    }
}
