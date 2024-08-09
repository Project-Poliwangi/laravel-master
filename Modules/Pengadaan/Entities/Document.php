<?php

namespace Modules\Pengadaan\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return \Modules\Pengadaan\Database\factories\DocumentFactory::new();
    }

    protected $table = 'pengadaan_documents';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_dokumen',
        'file',
        'deskripsi',
    ];
}
