<?php

namespace Modules\PeminjamanRuangan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\PeminjamanRuangan\Entities\Jurusan;

class JurusanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Jurusan::create([
            'nama' => 'Bisnis dan Informatika',
            'singkatan' => 'BI'
        ]);
    }
}
