<?php

namespace Modules\Monitoring\Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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

        $faker = Factory::create('id_ID'); // Menggunakan lokal bahasa Indonesia
        $createdAt = $faker->dateTimeBetween('-4 month', 'now'); 
        $updatedAt = $faker->dateTimeBetween($createdAt, 'now');

        foreach (range(1, 100) as $index) {
            DB::table('sub_perencanaans')->insert([
                'kegiatan' => $faker->sentence(3),
                'metode_pengadaan' => $faker->randomElement([
                    'Swakelola',
                    'Pengadaan Langsung',
                    'E-purchasing',
                    'Tender',
                    'Seleksi',
                    'Penunjukan Langsung'
                ]),
                'satuan' => $faker->word,
                'volume' => $faker->numberBetween(1, 100),
                'harga_satuan' => $faker->numberBetween(100000, 100000000),
                'output' => $faker->word,
                'rencana_mulai' => $faker->date(),
                'rencana_bayar' => $faker->date(),
                'file_hps' => $faker->word . '.pdf',
                'file_kak' => $faker->word . '.pdf',
                'perencanaan_id' => $faker->numberBetween(1, 50), // Asumsi bahwa tabel perencanaans memiliki ID antara 1 hingga 10
                'pic_id' => $faker->numberBetween(1, 20), // Asumsi bahwa tabel pegawais memiliki ID antara 1 hingga 10
                'ppk_id' => $faker->numberBetween(1, 20), // Asumsi bahwa tabel pegawais memiliki ID antara 1 hingga 10
                'pp_id' => $faker->optional()->numberBetween(1, 10), // Asumsi nullable
                'jenis' => $faker->randomElement([
                    'Barang',
                    'Jasa Konsultansi',
                    'Operasional',
                    'Pekerjaan Konstruksi'
                ]),
                'created_at' => $createdAt,
                'updated_at' => $updatedAt
            ]);
        }
    }
}