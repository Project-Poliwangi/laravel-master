<?php

namespace Modules\PeminjamanRuangan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\PeminjamanRuangan\Entities\Gedung;
use Modules\PeminjamanRuangan\Entities\Ruang;

class RuangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Ruang::create([
            'gedung_id' => Gedung::first()->id,
            'kode_bmn' => rand(0, 9999999999),
            'kode_qr' => 'T0SI102293',
            'nama' => 'G4.02',
            'luas' => 30,
            'kapasitas' => 30,
            'lantai' => 4,
            'foto' => 'test.png',
            'jenis' => 'Ruang Kelas',
        ]);
    }
}
