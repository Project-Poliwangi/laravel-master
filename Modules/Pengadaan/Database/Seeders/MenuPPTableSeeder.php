<?php

namespace Modules\Pengadaan\Database\Seeders;

use App\Models\Core\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MenuPPTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

            // Menu Role PP
            Menu::create([
                'modul' => 'Pengadaan',
                'label' => 'Dashboard',
                'url' => 'pp/dashboard',
                'can' => serialize(['pp']),
                'icon' => 'fas fa-home',
                'urut' => 1,
                'parent_id' => 0,
                'active' => serialize(['pp/dashboard', 'pp/dashboard*']),
            ]);

            // Menu Role PP
            Menu::create([
                'modul' => 'Pengadaan',
                'label' => 'Daftar Pengadaan',
                'url' => 'pp/daftarpengadaan',
                'can' => serialize(['pp']),
                'icon' => 'fas fa-list',
                'urut' => 2,
                'parent_id' => 0,
                'active' => serialize(['pp/daftarpengadaan', 'pp/daftarpengadaan*']),
            ]);



            // $this->call("OthersTableSeeder");
        
    }
}
