<?php

namespace Modules\PeminjamanRuangan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\PeminjamanRuangan\Entities\MataKuliah;
use Modules\PeminjamanRuangan\Entities\ProgramStudi;

class MataKuliahTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        MataKuliah::create([
            'kode' => 'BI212993',
            'program_studi_id' => ProgramStudi::first()->id,
            'nama' => 'Pemrograman Web',
            'jenis' => 'Praktikum',
            'sks' => 3
        ]);
    }
}
