<?php

namespace Modules\Pengadaan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Core\Menu;

class MenuModulPengadaanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Menu::where('modul', 'Pengadaan')->delete();

        // Menu Admin
        $menu = Menu::create([       
            'modul' => 'Pengadaan',
            'label' => 'Pengadaan',
            'url' => '',
            'can' => serialize(['admin']),
            'icon' => 'fas fa-users-cog',
            'urut' => 4,
            'parent_id' => 0,
            'active' => serialize(['pengadaan']),
        ]);
        if($menu){
            Menu::create([
                'modul' => 'Pengadaan',
                'label' => 'Template Dokumen',
                'url' => 'admin/keloladokumen',
                'can' => serialize(['admin']),
                'icon' => 'fas fa-folder',
                'urut' => 1,
                'parent_id' => $menu->id,
                'active' => serialize(['admin/templatedokumen','admin/templatedokumen*']),
            ]);
        }

        // Menu Direktur
        Menu::create([
            'modul' => 'Pengadaan',
            'label' => 'Dashboard',
            'url' => 'direktur/dashboard',
            'can' => serialize(['direktur']),
            'icon' => 'fas fa-home',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['direktur/dashboard','direktur/dashboard*']),
        ]);

        Menu::create([
            'modul' => 'Pengadaan',
            'label' => 'Daftar Pengadaan',
            'url' => 'direktur/daftarpengadaan',
            'can' => serialize(['direktur']),
            'icon' => 'fas fa-solid fa-list',
            'urut' => 2,
            'parent_id' => 0,
            'active' => serialize(['direktur/daftarpengadaan','direktur/daftarpengadaan*']),
        ]);

        // Menu PPK
        Menu::create([
            'modul' => 'Pengadaan',
            'label' => 'Dashboard',
            'url' => 'ppk/dashboard',
            'can' => serialize(['ppk']),
            'icon' => 'fas fa-home',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['ppk/dashboard','ppk/dashboard*']),
        ]);

        Menu::create([
            'modul' => 'Pengadaan',
            'label' => 'Daftar Pengadaan',
            'url' => 'ppk/daftarpengadaan',
            'can' => serialize(['ppk']),
            'icon' => 'fas fa-solid fa-list',
            'urut' => 2,
            'parent_id' => 0,
            'active' => serialize(['ppk/daftarpengadaan','ppk/daftarpengadaan*']),
        ]);

        $menuppk = Menu::create([
            'modul' => 'Pengadaan',
            'label' => 'Dokumen',
            'url' => '',
            'can' => serialize(['ppk']),
            'icon' => 'fas fa-folder',
            'urut' => 3,
            'parent_id' => 0,
            'active' => serialize(['pengadaan']),
        ]);
        if($menuppk){
            Menu::create([
                'modul' => 'Pengadaan',
                'label' => 'Penetapan',
                'url' => 'ppk/penetapan',
                'can' => serialize(['ppk']),
                'icon' => 'far fa-file',
                'urut' => 1,
                'parent_id' => $menuppk->id,
                'active' => serialize(['ppk/penetapan','ppk/penetapan*']),
            ]);

            Menu::create([
                'modul' => 'Pengadaan',
                'label' => 'Kontrak',
                'url' => 'ppk/kontrak',
                'can' => serialize(['ppk']),
                'icon' => 'far fa-file',
                'urut' => 2,
                'parent_id' => $menuppk->id,
                'active' => serialize(['ppk/kontrak','ppk/kontrak*']),
            ]);

            Menu::create([
                'modul' => 'Pengadaan',
                'label' => 'Serah Terima',
                'url' => 'ppk/serahterima',
                'can' => serialize(['ppk']),
                'icon' => 'far fa-file',
                'urut' => 3,
                'parent_id' => $menuppk->id,
                'active' => serialize(['ppk/serahterima','ppk/serahterima*']),
            ]);
        }

        // Menu Unit/Jurusan
        Menu::create([
            'modul' => 'Pengadaan',
            'label' => 'Dashboard',
            'url' => 'unit/dashboard',
            'can' => serialize(['kajur, kaunit']),
            'icon' => 'fas fa-home',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['unit/dashboard','unit/dashboard*']),
        ]);

        Menu::create([
            'modul' => 'Pengadaan',
            'label' => 'Daftar Pengadaan',
            'url' => 'unit/daftarpengadaan',
            'can' => serialize(['kajur, kaunit']),
            'icon' => 'fas fa-solid fa-list',
            'urut' => 2,
            'parent_id' => 0,
            'active' => serialize(['unit/daftarpengadaan','unit/daftarpengadaan*']),
        ]);

        Menu::create([
            'modul' => 'Pengadaan',
            'label' => 'Template Dokumen',
            'url' => 'unit/templatedokumen',
            'can' => serialize(['kajur, kaunit']),
            'icon' => 'fas fa-file-download',
            'urut' => 3,
            'parent_id' => 0,
            'active' => serialize(['unit/templatedokumen','unit/templatedokumen*']),
        ]);

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
