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
}
