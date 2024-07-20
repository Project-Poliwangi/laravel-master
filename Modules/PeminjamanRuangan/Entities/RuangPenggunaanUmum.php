<?php

namespace Modules\PeminjamanRuangan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RuangPenggunaanUmum extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'ruang_penggunaan_umums';

    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }
}
