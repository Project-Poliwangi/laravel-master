<?php

namespace Modules\PeminjamanRuangan\Entities;

use App\Models\Core\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RuangPenggunaanKuliah extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'ruang_penggunaan_kuliahs';

    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class);
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'dosen_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
