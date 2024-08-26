<?php

namespace Modules\Pengadaan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Pengadaan\Database\Seeders\MenuModulPengadaanTableSeeder;

class PengadaanDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(MenuModulPengadaanTableSeeder::class);
        $this->call(CreateUserModulPengadaanTableSeeder::class);
    }
}
