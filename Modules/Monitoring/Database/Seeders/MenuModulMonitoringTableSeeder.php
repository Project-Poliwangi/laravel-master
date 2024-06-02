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
            'label' => 'Monitoring',
            'url' => 'monitoring',
            'can' => serialize(['admin', 'perencanaan', 'penanggung', 'keuangan']),
            'icon' => 'fas fa-money-bill',
            'urut' => 3,
            'parent_id' => 0,
            'active' => serialize(['monitoring']),
        ]);

        if ($menu) {
            Menu::create([
                'modul' => 'Monitoring',
                'label' => 'Perencanaan',
                'url' => 'monitoring/perencanaan',
                'can' => serialize(['admin', 'perencanaan', 'penanggung', 'keuangan']),
                'icon' => 'fas fa-chart-line',
                'urut' => 1,
                'parent_id' => $menu->id,
                'active' => serialize(['monitoring/perencanaan', 'monitoring/perencanaan*']),
            ]);
    
            Menu::create([
                'modul' => 'Monitoring',
                'label' => 'Realisasi',
                'url' => 'monitoring/realisasi',
                'can' => serialize(['admin', 'perencanaan', 'penanggung', 'keuangan']),
                'icon' => 'fas fa-clipboard-check',
                'urut' => 2,
                'parent_id' => $menu->id,
                'active' => serialize(['monitoring/realisasi', 'monitoring/realisasi*']),
            ]);
    
            Menu::create([
                'modul' => 'Monitoring',
                'label' => 'Laporan Bulanan',
                'url' => 'monitoring/laporan_bulanan',
                'can' => serialize(['admin', 'perencanaan', 'penanggung', 'keuangan']),
                'icon' => 'fas fa-file-alt',
                'urut' => 3,
                'parent_id' => $menu->id,
                'active' => serialize(['monitoring/_bulanan', 'monitoring/laporan_bulanan*']),
            ]);

            Menu::create([
                'modul' => 'Monitoring',
                'label' => 'Laporan Triwulan',
                'url' => 'monitoring/laporan_triwulan',
                'can' => serialize(['admin', 'perencanaan', 'penanggung', 'keuangan']),
                'icon' => 'fas fa-file-alt',
                'urut' => 3,
                'parent_id' => $menu->id,
                'active' => serialize(['monitoring/laporan_triwulan', 'monitoring/laporan_triwulan*']),
            ]);
        }
    }
}
