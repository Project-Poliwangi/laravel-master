<?php

namespace Modules\PeminjamanRuangan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\PeminjamanRuangan\Entities\Jurusan;
use Modules\PeminjamanRuangan\Entities\ProgramStudi;

class ProgramStudiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        ProgramStudi::create([
            'jurusan_id' => Jurusan::first()->id,
            'nama' => 'D4 - Teknologi Rekayasa Perangkat Lunak',
            'singkatan' => 'TRPL'
        ]);
    }
}
