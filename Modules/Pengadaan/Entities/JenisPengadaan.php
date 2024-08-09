<?php

namespace Modules\Pengadaan\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPengadaan extends Model
{
    use HasFactory;

    protected $table = 'jenis_pengadaans';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_jenis'
    ];

    /**
     * Relasi ke model SubPerencanaan.
     * 
     * JenisPengadaan dapat memiliki banyak SubPerencanaan.
     */
    public function subPerencanaan()
    {
        return $this->hasMany(SubPerencanaan::class, 'jenis_pengadaan_id');
    }
}
