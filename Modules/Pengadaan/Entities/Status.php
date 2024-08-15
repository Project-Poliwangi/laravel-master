<?php

namespace Modules\Pengadaan\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'pengadaan_status';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_status',
    ];

    // Relasi ke Model Pengadaan
    public function pengadaan()
    {
        return $this->hasMany(Pengadaan::class, 'status_id');
    }

    /**
     * Relasi ke model HistoryPengadaan untuk status_lama.
     * Menghubungkan id di tabel pengadaan_status dengan status_lama di tabel history_pengadaan.
     */
    public function historyLama()
    {
        return $this->hasMany(HistoryPengadaan::class, 'status_lama');
    }

    /**
     * Relasi ke model HistoryPengadaan untuk status_baru.
     * Menghubungkan id di tabel pengadaan_status dengan status_baru di tabel history_pengadaan.
     */
    public function historyBaru()
    {
        return $this->hasMany(HistoryPengadaan::class, 'status_baru');
    }
}
