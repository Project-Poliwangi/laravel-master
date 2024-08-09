<?php

namespace Modules\Pengadaan\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'pengadaan_status';
    protected $primary = 'id';

    protected $fillable = [
        'nama_status',
    ];

    public function pengadaans()
    {
        return $this->hasMany(Pengadaan::class);
    }

    public function subperencanaans()
    {
        return $this->hasMany(SubPerencanaan::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
