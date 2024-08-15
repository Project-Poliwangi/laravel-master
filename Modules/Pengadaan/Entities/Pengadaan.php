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
        'status_id',
        'tanggal_status_0',
        'tanggal_status_1',
        'tanggal_status_2',
        'tanggal_status_3',
        'tanggal_status_4',
        'tanggal_status_5',
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

    // public function checkAndUpdateStatus()
    // {
    //     // Periksa apakah pengadaan memiliki relasi dengan subPerencanaan
    //     if (!$this->subPerencanaan) {
    //         return;
    //     }

    //     $subPerencanaan = $this->subPerencanaan;
    //     $currentDate = now()->toDateString(); // Ambil tanggal saat ini dalam format Y-m-d

    //     // Cek tipe dari rencana_mulai
    //     $rencanaMulai = $subPerencanaan->rencana_mulai;
    //     if (is_string($rencanaMulai)) {
    //         // Jika rencana_mulai adalah string, gunakan langsung
    //         $rencanaMulai = $rencanaMulai;
    //     } else {
    //         // Jika bukan string, ubah menjadi string
    //         $rencanaMulai = $rencanaMulai->toDateString();
    //     }

    // Cek apakah tanggal saat ini sudah sama atau lebih besar dari tanggal rencana mulai
    // Cek apakah tanggal saat ini sudah sama atau lebih besar dari tanggal rencana mulai
    // if ($currentDate >= $rencanaMulai) {
    //     if ($this->status->nama_status === 'Pra DIPA') {
    //         // Periksa apakah ada dokumen KAK, HPS, Stock Opname, atau Surat Ijin Impor yang diunggah
    //         if ($this->dokumen_kak || $this->dokumen_hps || $this->dokumen_stock_opname || $this->dokumen_surat_ijin_impor) {
    //             $status = 'Pemenuhan Dokumen';
    //         }
    //     } elseif ($this->status->nama_status === 'Pemenuhan Dokumen') {
    //         // Periksa apakah dokumen pemilihan penyedia telah diunggah oleh PP
    //         if ($this->dokumen_pemilihan_penyedia) {
    //             $status = 'Pemilihan Penyedia';
    //         }
    //     } elseif ($this->status->nama_status === 'Pemilihan Penyedia') {
    //         // Periksa apakah dokumen kontrak telah diunggah oleh PPK
    //         if ($this->dokumen_kontrak) {
    //             $status = 'Kontrak';
    //         }
    //     } elseif ($this->status->nama_status === 'Kontrak') {
    //         // Periksa apakah dokumen serah terima telah diunggah oleh PPK
    //         if ($this->dokumen_serah_terima) {
    //             $status = 'Serah Terima';
    //         }
    //     }

    //     // Temukan status berdasarkan nama dan simpan perubahan
    //     if (isset($status)) {
    //         $statusRecord = Status::where('nama_status', $status)->first();
    //         if ($statusRecord) {
    //             $this->status_id = $statusRecord->id;
    //             $this->save();
    //         }
    //     }
    // }

    public function checkAndUpdateStatus()
    {
        // Periksa apakah pengadaan memiliki relasi dengan subPerencanaan
        if (!$this->subPerencanaan) {
            return;
        }

        $subPerencanaan = $this->subPerencanaan;
        $currentDate = now()->toDateString(); // Ambil tanggal saat ini dalam format Y-m-d

        // Cek tipe dari rencana_mulai
        $rencanaMulai = $subPerencanaan->rencana_mulai;
        if (is_string($rencanaMulai)) {
            // Jika rencana_mulai adalah string, gunakan langsung
            $rencanaMulai = $rencanaMulai;
        } else {
            // Jika bukan string, ubah menjadi string
            $rencanaMulai = $rencanaMulai->toDateString();
        }

        // Cek apakah tanggal saat ini sudah sama atau lebih besar dari tanggal rencana mulai
        if ($currentDate >= $rencanaMulai) {
            if ($this->status->nama_status === 'Pemenuhan Dokumen') {
                // Update tanggal status
                if (!$this->tanggal_status_1) {
                    $this->tanggal_status_1 = $currentDate;
                }
                // Periksa apakah dokumen pemilihan penyedia telah diunggah oleh PP
                if ($this->dokumen_pemilihan_penyedia) {
                    $status = 'Pemilihan Penyedia';
                    // Update tanggal status
                    if (!$this->tanggal_status_2) {
                        $this->tanggal_status_2 = $currentDate;
                    }
                }
            } elseif ($this->status->nama_status === 'Pemilihan Penyedia') {
                // Periksa apakah dokumen kontrak telah diunggah oleh PPK
                if ($this->dokumen_kontrak) {
                    $status = 'Kontrak';
                    // Update tanggal status
                    if (!$this->tanggal_status_3) {
                        $this->tanggal_status_3 = $currentDate;
                    }
                }
            } elseif ($this->status->nama_status === 'Kontrak') {
                // Periksa apakah dokumen serah terima telah diunggah oleh PPK
                if ($this->dokumen_serah_terima) {
                    $status = 'Serah Terima';
                    // Update tanggal status
                    if (!$this->tanggal_status_4) {
                        $this->tanggal_status_4 = $currentDate;
                    }
                }
            }
        }

        // Temukan status berdasarkan nama dan simpan perubahan
        if (isset($status)) {
            $statusRecord = Status::where('nama_status', $status)->first();
            if ($statusRecord) {
                $this->status_id = $statusRecord->id;
                $this->save();
            }
        }
    }
}
