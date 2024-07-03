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
        'status',
    ];

    public function pengadaans()
    {
        return $this->hasMany(Pengadaan::class);
    }
}
