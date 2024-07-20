<?php

namespace Modules\PeminjamanRuangan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ruang extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'ruangs';

    public function gedung()
    {
        return $this->belongsTo(Gedung::class);
    }
}
