<?php

namespace Modules\Monitoring\Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Monitoring\Entities\Perencanaan;

class PerencanaanModulMonitoringTableSeeder extends Seeder
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
            DB::table('perencanaans')->insert([
                'nama' => $faker->sentence(3),
                'kode' => $faker->bothify('??-###'),
                'sumber' => $faker->randomElement(['PNP', 'RM', 'Hibah']),
                'revisi' => $faker->numberBetween(0, 2),
                'unit_id' => $faker->randomElement([
                    13, 14, 16, 18, 19, 20, 74, 
                    75,76, 77, 78, 79, 96, 97, 
                    98, 99, 100, 101, 102, 103, 
                    104, 106, 107, 110]), // Sesuaikan dengan ID yang ada di tabel units
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
