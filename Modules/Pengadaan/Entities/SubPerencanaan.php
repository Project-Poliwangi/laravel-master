<?php

namespace Modules\Pengadaan\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Kepegawaian\Entities\Pegawai;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubPerencanaan extends Model
{
    use HasFactory;

    protected $table = 'sub_perencanaans';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kegiatan',
        'metode_pengadaan_id',
        'jenis_pengadaan_id',
        'satuan',
        'volume',
        'harga_satuan',
        'pagu',
        'output',
        'rencana_mulai',
        'rencana_bayar',
        'perencanaan_id',
        'status_id',
        'unit_id',
        'pic_id',
        'ppk_id',
        'pp_id',
    ];

    // Relasi ke model Perencanaan
    public function perencanaan()
    {
        return $this->belongsTo(Perencanaan::class, 'perencanaan_id');
    }

    // Relasi ke Model Status
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    // Relasi ke Model Unit
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    // Relasi ke model Pegawai untuk PIC
    public function pic()
    {
        return $this->belongsTo(Pegawai::class, 'pic_id');
    }

    // Relasi ke model Pegawai untuk PPK
    public function ppk()
    {
        return $this->belongsTo(Pegawai::class, 'ppk_id');
    }

    // Relasi ke model Pegawai untuk PP (optional)
    public function pp()
    {
        return $this->belongsTo(Pegawai::class, 'pp_id');
    }

    // Relasi ke Model JenisPengadaan
    public function jenisPengadaan()
    {
        return $this->belongsTo(JenisPengadaan::class, 'jenis_pengadaan_id');
    }

    // Relasi ke Model MetodePengadaan
    public function metodePengadaan()
    {
        return $this->belongsTo(MetodePengadaan::class, 'metode_pengadaan_id');
    }

    // Relasi ke Model Pengadaan
    public function pengadaan()
    {
        return $this->hasOne(Pengadaan::class, 'subperencanaan_id');
    }
}
