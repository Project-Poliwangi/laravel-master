<?php

namespace Modules\Pengadaan\Database\Seeders;

use App\Models\Core\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MenuPerencanaanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Menu Perencanaan - Admin
        $menuperencanaan = Menu::create([
            'modul' => 'Pengadaan',
            'label' => 'Perencanaan',
            'url' => '',
            'can' => serialize(['admin']),
            'icon' => 'fas fa-list',
            'urut' => 3,
            'parent_id' => 0,
            'active' => serialize(['perencanaan']),
        ]);
        if ($menuperencanaan) {
            // Menu Perencanaan
            Menu::create([
                'modul' => 'Pengadaan',
                'label' => 'Perencanaan',
                'url' => 'perencanaan/daftarperencanaan',
                'can' => serialize(['admin']),
                'icon' => 'fas fa-users-cog',
                'urut' => 1,
                'parent_id' => $menuperencanaan->id,
                'active' => serialize(['perencanaan/daftarperencanaan', 'perencanaan/daftarperencanaan*']),
            ]);

            // Menu Sub Perencanaan
            Menu::create([
                'modul' => 'Pengadaan',
                'label' => 'Sub Perencanaan',
                'url' => 'subperencanaan/subperencanaan',
                'can' => serialize(['admin']),
                'icon' => 'fas fa-users-cog',
                'urut' => 2,
                'parent_id' => $menuperencanaan->id,
                'active' => serialize(['subperencanaan/subperencanaan', 'subperencanaan/subperencanaan*']),
            ]);



            // $this->call("OthersTableSeeder");
        }
    }
}
