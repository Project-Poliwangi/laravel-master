<?php

namespace Modules\Pengadaan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perencanaan extends Model
{
    use HasFactory;
    protected $table = 'perencanaans';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
        'kode',
        'sumber',
        'pagu',
        'revisi',
        'tahun',
    ];

    public function subPerencanaan()
    {
        return $this->hasMany(SubPerencanaan::class, 'perencanaan_id');
    }
}
