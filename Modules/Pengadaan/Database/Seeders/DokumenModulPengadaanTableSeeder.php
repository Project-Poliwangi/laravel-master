<?php

namespace Modules\Pengadaan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Pengadaan\Entities\Document;

class DokumenModulPengadaanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Document::create([
            'nama_dokumen'  => 'Kerangka Acuan Kerja (KAK)',
            'file' => 'kak_template.docx',
            'description' => 'Dokumen KAK yaitu dokumen Kerangka Acuan Kerja yang digunakan untuk mengajukan permohonan pengadaan',
        ]);

        Document::create([
            'nama_dokumen'  => 'Harga Perkiraan Sendiri (HPS)',
            'file' => 'hps_template.docx',
            'description' => 'Dokumen HPS yaitu dokumen Harga Perkiraan Sendiri yang digunakan untuk mengajukan permohonan pengadaan',
        ]);

        Document::create([
            'nama_dokumen'  => 'Stock Opname',
            'file' => 'stock_opname_template.docx',
            'description' => 'Dokumen Stock Opname yaitu dokumen yang digunakan untuk mencatat persediaan barang',
        ]);

        Document::create([
            'nama_dokumen'  => 'Surat Ijin Impor',
            'file' => 'surat_ijin_impor_template.docx',
            'description' => 'Dokumen Surat Ijin Impor yaitu dokumen yang digunakan untuk mengajukan permohonan impor',
        ]);

        // $this->call("OthersTableSeeder");
    }
}
