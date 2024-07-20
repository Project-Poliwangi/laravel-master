<?php

namespace Modules\PeminjamanRuangan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RuangPemesananUmum extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'ruang_pemesanan_umums';

    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }
}
