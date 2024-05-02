<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Core\Menu;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::truncate();
        Menu::create([
            'id' => 1,
            'modul' => 'Core',
            'label' => 'Master',
            'url' => '',
            'can' => serialize(['admin']),
            'icon' => 'fas fa-columns',
            'urut' => 1,
            'parent_id' => 0,
            'active' => '',
        ]);
        Menu::create([
            'id' => 2,
            'modul' => 'Core',
            'label' => 'User',
            'url' => 'users',
            'can' => serialize(['admin']),
            'icon' => 'fas fa-fw fa-users',
            'urut' => 1,
            'parent_id' => 1,
            'active' => serialize(['users','users*']),
        ]);
        Menu::create([
            'id' => 3,
            'modul' => 'Core',
            'label' => 'Menu',
            'url' => 'menus',
            'can' => serialize(['admin']),
            'icon' => 'fas fa-bars',
            'urut' => 2,
            'parent_id' => 1,
            'active' => serialize(['menus','menus*']),
        ]);
        Menu::create([
            'id' => 4,
            'modul' => 'Core',
            'label' => 'Roles & Permisions',
            'url' => '',
            'can' => serialize(['admin']),
            'icon' => 'fas fa-address-card',
            'urut' => 2,
            'parent_id' => 0,
            'active' => '',
        ]);
        Menu::create([
            'id' => 5,
            'modul' => 'Core',
            'label' => 'Roles',
            'url' => 'roles',
            'can' => serialize(['admin']),
            'icon' => 'far fa-circle',
            'urut' => 1,
            'parent_id' => 4,
            'active' => serialize(['roles','roles*']),
        ]);
        Menu::create([
            'id' => 6,
            'modul' => 'Core',
            'label' => 'Permissions',
            'url' => 'permissions',
            'can' => serialize(['admin']),
            'icon' => 'far fa-circle',
            'urut' => 2,
            'parent_id' => 4,
            'active' => serialize(['permissions','permissions*']),
        ]);

        // monitoring anggaran
        Menu::create([
            'id' => 7,
            'modul' => 'Core',
            'label' => 'Monitoring Anggaran',
            'url' => '',
            'can' => serialize(['admin']),
            'icon' => 'fas fa-money-check-alt',
            'urut' => 3,
            'parent_id' => 0,
            'active' => '',
        ]);
        
        Menu::create([
            'id' => 8,
            'modul' => 'Core',
            'label' => 'Perencanaan',
            'url' => 'monitoring/perencanaan',
            'can' => serialize(['admin']),
            'icon' => 'fas fa-file-alt',
            'urut' => 1,
            'parent_id' => 7,
            'active' => serialize(['perencanaan','perencanaan*']),
        ]);
        
        Menu::create([
            'id' => 9,
            'modul' => 'Core',
            'label' => 'Realisasi',
            'url' => 'monitoring/realisasi',
            'can' => serialize(['admin']),
            'icon' => 'fas fa-tasks',
            'urut' => 2,
            'parent_id' => 7,
            'active' => serialize(['realisasi','realisasi*']),
        ]);
        
        Menu::create([
            'id' => 10,
            'modul' => 'Core',
            'label' => 'Laporan',
            'url' => 'monitoring/laporan',
            'can' => serialize(['admin']),
            'icon' => 'far fa-chart-bar',
            'urut' => 3,
            'parent_id' => 7,
            'active' => serialize(['laporan','laporan*']),
        ]);
    }
}
