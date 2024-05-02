<?php

namespace Modules\Monitoring\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perencanaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 
        'kode', 
        'sumber', 
        'revisi',
        'unit_id'
    ];

    public function subPerencanaan()
    {
        return $this->hasMany('Modules\Monitoring\Entities\SubPerencanaan');
    }
}
