<?php

namespace Modules\Kepegawaian\Entities;

use App\Models\Core\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Pengadaan\Entities\SubPerencanaan;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $guarded = ['id'];
    
    protected static function newFactory()
    {
        return \Modules\Kepegawaian\Database\factories\PegawaiFactory::new();
    }

    public function subPerencanaans()
    {
        return $this->hasMany(SubPerencanaan::class, 'pic_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'pegawais_id');
    }
}
