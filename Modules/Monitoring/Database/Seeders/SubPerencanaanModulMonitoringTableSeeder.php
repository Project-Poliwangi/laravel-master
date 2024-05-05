<?php

namespace Modules\Monitoring\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Monitoring\Entities\SubPerencanaan;

class SubPerencanaanModulMonitoringTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        for ($i = 1; $i <= 5; $i++) {
            SubPerencanaan::create([
                'kegiatan' => 'Kegiatan ' . $i,
                'metode_pengadaan' => 'Pengadaan Langsung',
                'satuan' => 'Satuan ' . $i,
                'volume' => rand(1, 10), // Angka acak antara 1 dan 10
                'harga_satuan' => rand(10000, 50000), // Angka acak antara 10000 dan 50000
                'output' => 'Output ' . $i,
                'rencana_mulai' => now(),
                'rencana_bayar' => now(),
                'file_hps' => 'file_hps_' . $i . '.pdf',
                'file_kak' => 'file_kak_' . $i . '.pdf',
                'pic_id' => 1,
                'ppk_id' => 1,
                'jenis' => 'Operasional',
                'perencanaan_id' => 1,
            ]);
        }

        for ($i = 1; $i <= 4; $i++) {
            SubPerencanaan::create([
                'kegiatan' => 'Kegiatan ' . $i,
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Satuan ' . $i,
                'volume' => rand(1, 10), // Angka acak antara 1 dan 10
                'harga_satuan' => rand(10000, 50000), // Angka acak antara 10000 dan 50000
                'output' => 'Output ' . $i,
                'rencana_mulai' => now(),
                'rencana_bayar' => now(),
                'file_hps' => 'file_hps_' . $i . '.pdf',
                'file_kak' => 'file_kak_' . $i . '.pdf',
                'pic_id' => $i,
                'ppk_id' => $i,
                'jenis' => 'Barang',
                'perencanaan_id' => 1,
            ]);
        }
    }
}
