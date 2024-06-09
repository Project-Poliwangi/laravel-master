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
            'urut' => 1,
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
                'active' => serialize(['pengadaan/templatedokumen','pengadaan/templatedokumen*']),
            ]);
        }

        // Menu Direktur
        Menu::create([
            'modul' => 'Pengadaan',
            'label' => 'Daftar Permohonan',
            'url' => 'direktur/daftarpermohonan',
            'can' => serialize(['direktur']),
            'icon' => 'fas fa-solid fa-list',
            'urut' => 1,
            'parent_id' => 0,
            'active' => '',
        ]);

        Menu::create([
            'modul' => 'Pengadaan',
            'label' => 'Permohonan Diproses',
            'url' => 'direktur/permohonandiproses',
            'can' => serialize(['direktur']),
            'icon' => 'fas fa-circle-notch',
            'urut' => 2,
            'parent_id' => 0,
            'active' => '',
        ]);

        Menu::create([
            'modul' => 'Pengadaan',
            'label' => 'Permohonan Selesai',
            'url' => 'direktur/permohonanselesai',
            'can' => serialize(['direktur']),
            'icon' => 'fas fa-check-circle',
            'urut' => 3,
            'parent_id' => 0,
            'active' => '',
        ]);

        // Menu PPK
        Menu::create([
            'modul' => 'Pengadaan',
            'label' => 'Daftar Permohonan',
            'url' => 'daftarpermohonan',
            'can' => serialize(['ppk']),
            'icon' => 'fas fa-solid fa-list',
            'urut' => 1,
            'parent_id' => 0,
            'active' => '',
        ]);

        Menu::create([
            'modul' => 'Pengadaan',
            'label' => 'Permohonan Diproses',
            'url' => 'permohonandiproses',
            'can' => serialize(['ppk']),
            'icon' => 'fas fa-circle-notch',
            'urut' => 2,
            'parent_id'=> 0,
            'active' => '',
        ]);

        Menu::create([
            'modul' => 'Pengadaan',
            'label' => 'Permohonan Selesai',
            'url' => 'permohonanselesai',
            'can' => serialize(['ppk']),
            'icon' => 'fas fa-check-circle',
            'urut' => 3,
            'parent_id' => 0,
            'active' => '',
        ]);


        $menu = Menu::create([
            'modul' => 'Pengadaan',
            'label' => 'Dokumen',
            'url' => '',
            'can' => serialize(['ppk']),
            'icon' => 'fas fa-folder',
            'urut' => 4,
            'parent_id' => 0,
            'active' => serialize(['pengadaan']),
        ]);
        if($menu){
            Menu::create([
                'modul' => 'Pengadaan',
                'label' => 'Penetapan',
                'url' => 'ppk/penetapan',
                'can' => serialize(['ppk']),
                'icon' => 'far fa-file',
                'urut' => 1,
                'parent_id' => $menu->id,
                'active' => serialize(['pengadaan/penetapan','pengadaan/penetapan*']),
            ]);

            Menu::create([
                'modul' => 'Pengadaan',
                'label' => 'Kontrak',
                'url' => 'ppk/kontrak',
                'can' => serialize(['ppk']),
                'icon' => 'far fa-file',
                'urut' => 2,
                'parent_id' => $menu->id,
                'active' => serialize(['pengadaan/kontrak','pengadaan/kontrak*']),
            ]);

            Menu::create([
                'modul' => 'Pengadaan',
                'label' => 'Serah Terima',
                'url' => 'ppk/serahterima',
                'can' => serialize(['ppk']),
                'icon' => 'far fa-file',
                'urut' => 3,
                'parent_id' => $menu->id,
                'active' => serialize(['pengadaan/serahterima','pengadaan/serahterima*']),
            ]);
        }

        // Menu Unit/Jurusan
        Menu::create([
            'modul' => 'Pengadaan',
            'label' => 'Daftar Permohonan',
            'url' => 'unit/daftarpermohonan',
            'can' => serialize(['unit']),
            'icon' => 'fas fa-solid fa-list',
            'urut' => 1,
            'parent_id' => 0,
            'active' => '',
        ]);

        Menu::create([
            'modul' => 'Pengadaan',
            'label' => 'Permohonan Diproses',
            'url' => 'unit/permohonandiproses',
            'can' => serialize(['unit']),
            'icon' => 'fas fa-circle-notch',
            'urut' => 2,
            'parent_id' => 0,
            'active' => '',
        ]);

        Menu::create([
            'modul' => 'Pengadaan',
            'label' => 'Permohonan Selesai',
            'url' => 'unit/permohonanselesai',
            'can' => serialize(['unit']),
            'icon' => 'fas fa-check-circle',
            'urut' => 3,
            'parent_id' => 0,
            'active' => '',
        ]);

        Menu::create([
            'modul' => 'Pengadaan',
            'label' => 'Template Dokumen',
            'url' => 'unit/templatedokumen',
            'can' => serialize(['unit']),
            'icon' => 'fas fa-file-download',
            'urut' => 4,
            'parent_id' => 0,
            'active' => '',
        ]);

        // $this->call("OthersTableSeeder");
    }
}
