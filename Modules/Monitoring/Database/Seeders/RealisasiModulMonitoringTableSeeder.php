<?php

namespace Modules\Monitoring\Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RealisasiModulMonitoringTableSeeder extends Seeder
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

        foreach (range(1, 50) as $index) {
            DB::table('realisasis')->insert([
                'progres' => $faker->randomElement(['0', '25', '50', '75', '100']),
                'realisasi' => $faker->numberBetween(1000000, 100000000),
                'laporan_keuangan' => $faker->word . '.pdf',
                'laporan_kegiatan' => $faker->word . '.pdf',
                'ketercapian_output' => $faker->sentence(3),
                'tanggal_kontrak' => $faker->date(),
                'tanggal_pembayaran' => $faker->date(),
                'sub_perencanaan_id' => $faker->numberBetween(1, 20), // Sesuaikan dengan ID yang ada di tabel sub_perencanaans
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}