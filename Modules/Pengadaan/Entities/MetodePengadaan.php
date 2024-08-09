<?php

namespace Modules\Pengadaan\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePengadaan extends Model
{
    use HasFactory;

    protected $table = 'metode_pengadaans';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_metode'
    ];

    public function subPerencanaans()
    {
        return $this->hasMany(SubPerencanaan::class, 'metode_pengadaan_id');
    }
}