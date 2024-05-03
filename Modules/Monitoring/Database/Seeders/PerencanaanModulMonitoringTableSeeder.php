<?php

namespace Modules\Monitoring\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
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
        Perencanaan::create([
            'nama' => 'Perencanaan 1',
            'kode' => 'K001',
            'sumber' => 'PNP',
            'revisi' => 1,
            'unit_id' => 13,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Perencanaan::create([
            'nama' => 'Perencanaan 2',
            'kode' => 'K002',
            'sumber' => 'RM',
            'revisi' => 2,
            'unit_id' => 13,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // $this->call("OthersTableSeeder");
    }
}
