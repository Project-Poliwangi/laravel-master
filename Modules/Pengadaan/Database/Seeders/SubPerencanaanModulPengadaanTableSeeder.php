<?php

namespace Modules\Pengadaan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class SubPerencanaanModulPengadaanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('sub_perencanaans')->insert([
            [
                'kegiatan' => 'Pengadaan Bahan Praktikum - Jurusan Bisnis dan Informatika',
                'metode_pengadaan_id' => 3,
                'jenis_pengadaan_id' => 1,
                'volume' => 1,
                'satuan' => 'PAKET',
                'harga_satuan' => 60091000,
                'pagu' => 60091000,
                'rencana_mulai' => '2024-01-01',
                'rencana_bayar' => '2024-06-01',
                'perencanaan_id' => 5,
                'unit_id' => 74,
                'ppk_id' => 6,
            ],
            [
                'kegiatan' => 'Pengadaan peralatan laboratorium Bisnis dan Informatika',
                'metode_pengadaan_id' => 3,
                'jenis_pengadaan_id' => 1,
                'volume' => 1,
                'satuan' => 'Unit',
                'harga_satuan' => 141735000,
                'pagu' => 141735000,
                'rencana_mulai' => '2024-04-01',
                'rencana_bayar' => '2024-04-04',
                'perencanaan_id' => 9,
                'unit_id' => 74,
                'ppk_id' => 6,
            ],
            [
                'kegiatan' => 'Pengadaan Sarana dan Prasarana Pendukung Perpustakaan',
                'metode_pengadaan_id' => 3,
                'jenis_pengadaan_id' => 1,
                'volume' => 1,
                'satuan' => 'Paket',
                'harga_satuan' => 50000000,
                'pagu' => 50000000,
                'rencana_mulai' => '2024-01-01',
                'rencana_bayar' => '2024-01-04',
                'perencanaan_id' => 9,
                'unit_id' => 83,
                'ppk_id' => 6,
            ],
            [
                'kegiatan' => 'Langganan E-Jurnal',
                'metode_pengadaan_id' => 2,
                'jenis_pengadaan_id' => 1,
                'volume' => 1,
                'satuan' => 'Paket',
                'harga_satuan' => 13000000,
                'pagu' => 13000000,
                'rencana_mulai' => '2024-02-02',
                'rencana_bayar' => '2024-03-30',
                'perencanaan_id' => 4,
                'unit_id' => 83,
                'ppk_id' => 6,
            ],
        ]);

        // $this->call("OthersTableSeeder");
    }
}
