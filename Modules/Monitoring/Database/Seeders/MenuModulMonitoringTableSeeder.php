<?php

namespace Modules\Monitoring\Database\Seeders;

use App\Models\Core\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MenuModulMonitoringTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Menu::where('modul', 'Monitoring')->delete();
        Menu::create([
            'id' => 7,
            'modul' => 'Monitoring',
            'label' => 'Monitoring',
            'url' => 'monitoring',
            'can' => serialize(['admin', 'perencanaan', 'penanggung', 'keuangan']),
            'icon' => 'fas fa-money-bill',
            'urut' => 3,
            'parent_id' => 0,
            'active' => '',
        ]);

        Menu::create([
            'id' => 8,
            'modul' => 'Monitoring',
            'label' => 'Perencanaan',
            'url' => 'monitoring/perencanaan',
            'can' => serialize(['admin', 'perencanaan', 'penanggung', 'keuangan']),
            'icon' => 'fas fa-chart-line',
            'urut' => 1,
            'parent_id' => 7,
            'active' => serialize(['monitoring/perencanaan', 'monitoring/perencanaan*']),
        ]);

        Menu::create([
            'id' => 9,
            'modul' => 'Monitoring',
            'label' => 'Realisasi',
            'url' => 'monitoring/realisasi',
            'can' => serialize(['admin', 'perencanaan', 'penanggung', 'keuangan']),
            'icon' => 'fas fa-clipboard-check',
            'urut' => 2,
            'parent_id' => 7,
            'active' => serialize(['monitoring/realisasi', 'monitoring/realisasi*']),
        ]);

        Menu::create([
            'id' => 10,
            'modul' => 'Monitoring',
            'label' => 'Laporan',
            'url' => 'monitoring/laporan',
            'can' => serialize(['admin', 'perencanaan', 'penanggung', 'keuangan']),
            'icon' => 'fas fa-file-alt',
            'urut' => 3,
            'parent_id' => 7,
            'active' => serialize(['monitoring/laporan', 'monitoring/laporan*']),
        ]);
    }
}
