<?php

namespace Modules\Surat\Database\Seeders;

use App\Models\Core\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MenuModulSuratTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Menu::where('modul', 'Surat')->delete();
        $menu = Menu::create([
            'modul' => 'Surat',
            'label' => 'Surat',
            'url' => '',
            'can' => serialize(['admin']),
            'icon' => 'fas fa-envelope',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['surat']),
        ]);
        if ($menu) {
            Menu::create([
                'modul' => 'Surat',
                'label' => 'Surat Masuk',
                'url' => 'surat/surat-masuk',
                'can' => serialize(['admin']),
                'icon' => 'far fa-circle',
                'urut' => 1,
                'parent_id' => $menu->id,
                'active' => serialize(['surat/surat-masuk', 'surat-masuk*']),
            ]);
            Menu::create([
                'modul' => 'Surat',
                'label' => 'Arsip Surat',
                'url' => 'surat/arsip',
                'can' => serialize(['admin']),
                'icon' => 'far fa-circle',
                'urut' => 1,
                'parent_id' => $menu->id,
                'active' => serialize(['surat/arsip', 'surat/arsip*']),
            ]);


            // $this->call("OthersTableSeeder");
        }
    }
}
