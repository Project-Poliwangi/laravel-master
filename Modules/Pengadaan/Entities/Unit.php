<?php

namespace Modules\Pengadaan\Entities;

use App\Models\Core\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Kepegawaian\Entities\Pegawai;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{

    use HasFactory;

    protected $table = 'units';
    protected $primaryKey = 'id';

    protected $fillable = ['nama'];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'unit_id');
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

    public function user()
    {
        return $this->hasMany(User::class, 'unit', 'id');
    }

    public function subPerencanaan()
    {
        return $this->hasMany(SubPerencanaan::class, 'unit_id');
    }
}