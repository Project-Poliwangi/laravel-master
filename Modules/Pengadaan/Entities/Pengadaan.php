<?php

namespace Modules\Pengadaan\Entities;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengadaan extends Model
{
    use HasFactory;

    protected $table = 'pengadaan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'catatan',
        'dokumen_kak',
        'dokumen_hps',
        'dokumen_stock_opname',
        'dokumen_surat_ijin_impor',
        'dokumen_kontrak',
        'dokumen_serah_terima',
        'subperencanaan_id',
        'status_id'
    ];

    // Relasi ke Model SubPerencanaan
    public function subPerencanaan()
    {
        return $this->belongsTo(SubPerencanaan::class, 'subperencanaan_id');
    }

    // Relasi ke Model Status
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    // Model Pengadaan
    public function updateStatusBasedOnDocuments(Request $request)
    {
        $currentDate = now();
        $status = 'Belum dalam periode';

        if ($currentDate >= $this->subPerencanaan->rencana_mulai) {
            if (!$request->hasFile('dokumen_pemilihan_penyedia') && !$request->hasFile('dokumen_kontrak') && !$request->hasFile('dokumen_serah_terima')) {
                if ($request->hasFile('dokumen_kak') && $request->hasFile('dokumen_hps') && $request->hasFile('dokumen_stock_opname') && $request->hasFile('dokumen_surat_ijin_impor')) {
                    $status = 'Pemenuhan Dokumen';
                } else {
                    $status = 'Pra DIPA';
                }
            } elseif ($request->hasFile('dokumen_pemilihan_penyedia')) {
                $status = 'Pemilihan Penyedia';
            } elseif ($request->hasFile('dokumen_kontrak')) {
                $status = 'Kontrak';
            } elseif ($request->hasFile('dokumen_serah_terima')) {
                $status = 'Serah Terima';
            }
        }

        if ($status != 'Belum dalam periode') {
            $statusRecord = Status::where('nama_status', $status)->first();
            $this->status_id = $statusRecord->id;
        }
    }
}
