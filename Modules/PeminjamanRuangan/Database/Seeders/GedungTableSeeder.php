<?php

namespace Modules\PeminjamanRuangan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\PeminjamanRuangan\Entities\Gedung;

class GedungTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Gedung::create([
            'kode' => 'G4',
            'nama' => 'Gedung GKT Lantai 4',
            'lokasi' => 'loremipsumdolorsitamet',
            'foto' => 'test.png',
            'luas' => 30,
        ]);
    }
}
