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
            'kode' => 'PRC001',
            'sumber' => 'pemerintah',
            'revisi' => '1',
            'unit_id' => 13
        ]);

        Perencanaan::create([
            'nama' => 'Perencanaan 2',
            'kode' => 'PRC002',
            'sumber' => 'pemerintah',
            'revisi' => '2',
            'unit_id' => 13
        ]);

        // $this->call("OthersTableSeeder");
    }
}
