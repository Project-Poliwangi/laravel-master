<?php

namespace Modules\Keuangan\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Kepegawaian\Entities\Pegawai;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{

    use HasFactory;

    protected $table = 'units';
    protected $primaryKey = 'id';

    public function pegawais()
    {
        return $this->hasMany(Pegawai::class, 'unit_id');
    }
}