<?php

namespace Modules\PeminjamanRuangan\Database\Seeders;

use App\Models\Core\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MenuModulPeminjamanRuanganTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Menu::create([
            'modul' => 'PeminjamanRuangan',
            'label' => 'Kelola Peminjaman',
            'url' => 'kelola-peminjaman',
            'can' => serialize(['pengelola-ruangan', 'admin']),
            'icon' => 'fas fa-edit',
            'urut' => 11,
            'parent_id' => 0,
            'active' => '',
        ]);
        $menu = Menu::create([
            'modul' => 'PeminjamanRuangan',
            'label' => 'Kelola Data',
            'url' => '',
            'can' => serialize(['pengelola-ruangan', 'admin']),
            'icon' => 'fas fa-columns',
            'urut' => 12,
            'parent_id' => 0,
            'active' => '',
        ]);
        Menu::create([
            'modul' => 'PeminjamanRuangan',
            'label' => 'Kelola Data Gedung',
            'url' => 'kelola-gedung',
            'can' => serialize(['pengelola-ruangan', 'admin']),
            'icon' => 'far fa-circle',
            'urut' => 1,
            'parent_id' => $menu->id,
            'active' => '',
        ]);
        Menu::create([
            'modul' => 'PeminjamanRuangan',
            'label' => 'Kelola Data Ruangan',
            'url' => 'kelola-ruangan',
            'can' => serialize(['pengelola-ruangan', 'admin']),
            'icon' => 'far fa-circle',
            'urut' => 2,
            'parent_id' => $menu->id,
            'active' => '',
        ]);
        Menu::create([
            'modul' => 'PeminjamanRuangan',
            'label' => 'Penjadwalan',
            'url' => 'penjadwalan',
            'can' => serialize(['pengelola-ruangan', 'admin']),
            'icon' => 'fas fa-calendar',
            'urut' => 13,
            'parent_id' => 0,
            'active' => '',
        ]);
        Menu::create([
            'modul' => 'PeminjamanRuangan',
            'label' => 'Kelola Mata Kuliah',
            'url' => 'kelola-mata-kuliah',
            'can' => serialize(['pengelola-ruangan', 'admin']),
            'icon' => 'fas fa-file',
            'urut' => 14,
            'parent_id' => 0,
            'active' => '',
        ]);
        $menu = Menu::create([
            'modul' => 'PeminjamanRuangan',
            'label' => 'Daftar Ruangan',
            'url' => '',
            'can' => serialize(['peminjam', 'admin']),
            'icon' => 'fas fa-door-closed',
            'urut' => 15,
            'parent_id' => 0,
            'active' => '',
        ]);
        Menu::create([
            'modul' => 'PeminjamanRuangan',
            'label' => 'Ruangan Tersedia',
            'url' => 'ruangan/tersedia',
            'can' => serialize(['peminjam', 'admin']),
            'icon' => 'far fa-circle',
            'urut' => 1,
            'parent_id' => $menu->id,
            'active' => '',
        ]);
        Menu::create([
            'modul' => 'PeminjamanRuangan',
            'label' => 'Ruangan Terpakai',
            'url' => 'ruangan/terpakai',
            'can' => serialize(['peminjam', 'admin']),
            'icon' => 'far fa-circle',
            'urut' => 2,
            'parent_id' => $menu->id,
            'active' => '',
        ]);
        Menu::create([
            'modul' => 'PeminjamanRuangan',
            'label' => 'Peminjaman',
            'url' => 'peminjaman',
            'can' => serialize(['peminjam', 'admin']),
            'icon' => 'fas fa-user-circle',
            'urut' => 16,
            'parent_id' => 0,
            'active' => '',
        ]);
    }
}
