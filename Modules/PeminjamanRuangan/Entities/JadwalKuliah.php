<?php

namespace Modules\PeminjamanRuangan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalKuliah extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'jadwal_kuliahs';

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class);
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'dosen_id');
    }
}
