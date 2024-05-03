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
        $menu = Menu::create([
            'modul' => 'Monitoring',
            'label' => 'Monitoring Anggaran',
            'url' => '',
            'can' => serialize(['admin']),
            'icon' => 'fas fa-money-check-alt',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['monitoring']),
        ]);

        if ($menu) {
            Menu::create([
                'modul' => 'Monitoring',
                'label' => 'Perencanaan',
                'url' => 'monitoring/perencanaan',
                'can' => serialize(['admin']),
                'icon' => 'fas fa-file-alt',
                'urut' => 1,
                'parent_id' => $menu->id,
                'active' => serialize(['monitoring/perencanaan', 'monitoring/perencanaan*']),
            ]);

            Menu::create([
                'modul' => 'Monitoring',
                'label' => 'Realisasi',
                'url' => 'monitoring/realisasi',
                'can' => serialize(['admin']),
                'icon' => 'fas fa-tasks',
                'urut' => 2,
                'parent_id' => $menu->id,
                'active' => serialize(['monitoring/realisasi', 'monitoring/realisasi*']),
            ]);

            Menu::create([
                'modul' => 'Monitoring',
                'label' => 'Laporan',
                'url' => 'monitoring/laporan',
                'can' => serialize(['admin']),
                'icon' => 'far fa-chart-bar',
                'urut' => 3,
                'parent_id' => $menu->id,
                'active' => serialize(['monitoring/laporan', 'monitoring/laporan*']),
            ]);
        }
    }
}
