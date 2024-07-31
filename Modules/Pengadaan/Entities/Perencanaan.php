<?php

namespace Modules\Pengadaan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perencanaan extends Model
{
    use HasFactory;
    protected $table = 'perencanaans';
    protected $primary = 'id';

    protected $fillable = [
        'nama', 'kode', 'sumber', 'revisi', 'unit_id'
    ];

    public function subPerencanaans()
    {
        return $this->hasMany(SubPerencanaan::class, 'perencanaan_id');
    }

}