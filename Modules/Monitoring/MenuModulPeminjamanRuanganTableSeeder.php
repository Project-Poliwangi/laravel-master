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
            'modul' => 'Peminjaman Ruangan',
            'label' => 'Kelola Peminjaman',
            'url' => '',
            'can' => serialize(['Pengelola Ruangan', 'admin']),
            'icon' => 'fas fa-edit',
            'urut' => 10,
            'parent_id' => 0,
            'active' => '',
        ]);
        $kelolaData = Menu::create([
            'modul' => 'Peminjaman Ruangan',
            'label' => 'Kelola Data',
            'url' => '',
            'can' => serialize(['Pengelola Ruangan', 'admin']),
            'icon' => 'fas fa-columns',
            'urut' => 11,
            'parent_id' => 0,
            'active' => '',
        ]);
        Menu::create([
            'modul' => 'Peminjaman Ruangan',
            'label' => 'Kelola Data Gedung',
            'url' => '',
            'can' => serialize(['Pengelola Ruangan', 'admin']),
            'icon' => 'fas fa-circle',
            'urut' => 1,
            'parent_id' => $kelolaData->id,
            'active' => '',
        ]);
        Menu::create([
            'modul' => 'Peminjaman Ruangan',
            'label' => 'Kelola Data Ruangan',
            'url' => '',
            'can' => serialize(['Pengelola Ruangan', 'admin']),
            'icon' => 'fas fa-circle',
            'urut' => 2,
            'parent_id' => $kelolaData->id,
            'active' => '',
        ]);
        Menu::create([
            'modul' => 'Peminjaman Ruangan',
            'label' => 'Penjadwalan',
            'url' => '',
            'can' => serialize(['Pengelola Ruangan', 'admin']),
            'icon' => 'fas fa-calendar',
            'urut' => 12,
            'parent_id' => 0,
            'active' => '',
        ]);
        Menu::create([
            'modul' => 'Peminjaman Ruangan',
            'label' => 'Kelola Mata Kuliah',
            'url' => '',
            'can' => serialize(['Pengelola Ruangan', 'admin']),
            'icon' => 'fas fa-file',
            'urut' => 13,
            'parent_id' => 0,
            'active' => '',
        ]);
    }
}
