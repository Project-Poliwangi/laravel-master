<?php

namespace Modules\Pengadaan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Core\Menu;

class MenuAdminModulPengadaanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

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
        $menudirektur = Menu::create([       
            'modul' => 'Pengadaan',
            'label' => 'Direktur',
            'url' => '',
            'can' => serialize(['admin']),
            'icon' => 'fas fa-users-cog',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['pengadaan']),
        ]);
        if($menudirektur){
            Menu::create([
                'modul' => 'Pengadaan',
                'label' => 'Daftar Permohonan',
                'url' => 'direktur/daftarpermohonan',
                'can' => serialize(['direktur', 'admin']),
                'icon' => 'fas fa-solid fa-list',
                'urut' => 1,
                'parent_id' => $menudirektur->id,
                'active' => serialize(['direktur/daftarpermohonan','direktur/daftarpermohonan*']),
            ]);

            Menu::create([
                'modul' => 'Pengadaan',
                'label' => 'Permohonan Diproses',
                'url' => 'direktur/permohonandiproses',
                'can' => serialize(['direktur', 'admin']),
                'icon' => 'fas fa-circle-notch',
                'urut' => 2,
                'parent_id' => $menudirektur->id,
                'active' => serialize(['direktur/permohonandiproses','direktur/permohonandiproses*']),
            ]);

            Menu::create([
                'modul' => 'Pengadaan',
                'label' => 'Permohonan Selesai',
                'url' => 'direktur/permohonanselesai',
                'can' => serialize(['direktur', 'admin']),
                'icon' => 'fas fa-check-circle',
                'urut' => 3,
                'parent_id' => $menudirektur->id,
                'active' => serialize(['direktur/permohonanselesai','direktur/permohonanselesai*']),
            ]);
        }

        // Menu PPK
        $menuppk = Menu::create([       
            'modul' => 'Pengadaan',
            'label' => 'PPK',
            'url' => '',
            'can' => serialize(['admin']),
            'icon' => 'fas fa-users-cog',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['pengadaan']),
        ]);
        if($menuppk){
            Menu::create([
                'modul' => 'Pengadaan',
                'label' => 'Daftar Permohonan',
                'url' => 'ppk/daftarpermohonan',
                'can' => serialize(['ppk', 'admin']),
                'icon' => 'fas fa-solid fa-list',
                'urut' => 1,
                'parent_id' => $menuppk->id,
                'active' => serialize(['ppk/daftarpermohonan','ppk/daftarpermohonan*']),
            ]);
    
            Menu::create([
                'modul' => 'Pengadaan',
                'label' => 'Permohonan Diproses',
                'url' => 'ppk/permohonandiproses',
                'can' => serialize(['ppk', 'admin']),
                'icon' => 'fas fa-circle-notch',
                'urut' => 2,
                'parent_id'=> $menuppk->id,
                'active' => serialize(['ppk/permohonandiproses','ppk/permohonandiproses*']),
            ]);
    
            Menu::create([
                'modul' => 'Pengadaan',
                'label' => 'Permohonan Selesai',
                'url' => 'ppk/permohonanselesai',
                'can' => serialize(['ppk', 'admin']),
                'icon' => 'fas fa-check-circle',
                'urut' => 3,
                'parent_id' => $menuppk->id,
                'active' => serialize(['ppk/permohonanselesai','ppk/permohonanselesai*']),
            ]);
    
            Menu::create([
                'modul' => 'Pengadaan',
                'label' => 'Penetapan',
                'url' => 'ppk/penetapan',
                'can' => serialize(['ppk', 'admin']),
                'icon' => 'far fa-file',
                'urut' => 1,
                'parent_id' => $menuppk->id,
                'active' => serialize(['ppk/penetapan','ppk/penetapan*']),
            ]);

            Menu::create([
                'modul' => 'Pengadaan',
                'label' => 'Kontrak',
                'url' => 'ppk/kontrak',
                'can' => serialize(['ppk', 'admin']),
                'icon' => 'far fa-file',
                'urut' => 2,
                'parent_id' => $menuppk->id,
                'active' => serialize(['ppk/kontrak','ppk/kontrak*']),
            ]);

            Menu::create([
                'modul' => 'Pengadaan',
                'label' => 'Serah Terima',
                'url' => 'ppk/serahterima',
                'can' => serialize(['ppk', 'admin']),
                'icon' => 'far fa-file',
                'urut' => 3,
                'parent_id' => $menuppk->id,
                'active' => serialize(['ppk/serahterima','ppk/serahterima*']),
            ]);
        }

        // Menu Unit/Jurusan
        $menuunit = Menu::create([       
            'modul' => 'Pengadaan',
            'label' => 'Unit',
            'url' => '',
            'can' => serialize(['admin']),
            'icon' => 'fas fa-users-cog',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['pengadaan']),
        ]);
        if($menuunit){
            Menu::create([
                'modul' => 'Pengadaan',
                'label' => 'Daftar Permohonan',
                'url' => 'unit/daftarpermohonan',
                'can' => serialize(['unit', 'admin']),
                'icon' => 'fas fa-solid fa-list',
                'urut' => 1,
                'parent_id' => $menuunit->id,
                'active' => serialize(['unit/daftarpermohonan','unit/daftarpermohonan*']),
            ]);
    
            Menu::create([
                'modul' => 'Pengadaan',
                'label' => 'Permohonan Diproses',
                'url' => 'unit/permohonandiproses',
                'can' => serialize(['unit', 'admin']),
                'icon' => 'fas fa-circle-notch',
                'urut' => 2,
                'parent_id' => $menuunit->id,
                'active' => serialize(['unit/permohonandiproses','unit/permohonandiproses*']),
            ]);
    
            Menu::create([
                'modul' => 'Pengadaan',
                'label' => 'Permohonan Selesai',
                'url' => 'unit/permohonanselesai',
                'can' => serialize(['unit', 'admin']),
                'icon' => 'fas fa-check-circle',
                'urut' => 3,
                'parent_id' => $menuunit->id,
                'active' => serialize(['unit/permohonanselesai','unit/permohonanselesai*']),
            ]);
    
            Menu::create([
                'modul' => 'Pengadaan',
                'label' => 'Template Dokumen',
                'url' => 'unit/templatedokumen',
                'can' => serialize(['unit', 'admin']),
                'icon' => 'fas fa-file-download',
                'urut' => 4,
                'parent_id' => $menuunit->id,
                'active' => serialize(['unit/templatedokumen','unit/templatedokumen*']),
            ]);
        }

        // $this->call("OthersTableSeeder");
    }
}
