<?php

namespace Modules\PeminjamanRuangan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MataKuliah extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'mata_kuliahs';

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class);
    }
}
