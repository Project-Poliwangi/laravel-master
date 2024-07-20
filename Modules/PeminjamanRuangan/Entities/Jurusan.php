<?php

namespace Modules\PeminjamanRuangan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jurusan extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'jurusans';
}
