<?php

namespace Modules\Pengadaan\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'pengadaan_documents';
    protected $primary = 'id';

    protected $fillable = [
        'nama_dokumen',
        'file',
        'description',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
