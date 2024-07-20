<?php

namespace Modules\PeminjamanRuangan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramStudi extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'program_studis';

    public function Jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }
}
