<?php

namespace Modules\Pengadaan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Core\Menu;

class MenuUnitModulPengadaanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Menu Unit/Jurusan
        Menu::create([
            'modul' => 'Pengadaan',
            'label' => 'Daftar Permohonan',
            'url' => 'unit/daftarpermohonan',
            'can' => serialize(['unit']),
            'icon' => 'fas fa-solid fa-list',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['unit/daftarpermohonan','unit/daftarpermohonan*']),
        ]);

        Menu::create([
            'modul' => 'Pengadaan',
            'label' => 'Permohonan Diproses',
            'url' => 'unit/permohonandiproses',
            'can' => serialize(['unit']),
            'icon' => 'fas fa-circle-notch',
            'urut' => 2,
            'parent_id' => 0,
            'active' => serialize(['unit/permohonandiproses','unit/permohonandiproses*']),
        ]);

        Menu::create([
            'modul' => 'Pengadaan',
            'label' => 'Permohonan Selesai',
            'url' => 'unit/permohonanselesai',
            'can' => serialize(['unit']),
            'icon' => 'fas fa-check-circle',
            'urut' => 3,
            'parent_id' => 0,
            'active' => serialize(['unit/permohonanselesai','unit/permohonanselesai*']),
        ]);

        Menu::create([
            'modul' => 'Pengadaan',
            'label' => 'Template Dokumen',
            'url' => 'unit/templatedokumen',
            'can' => serialize(['unit']),
            'icon' => 'fas fa-file-download',
            'urut' => 4,
            'parent_id' => 0,
            'active' => serialize(['unit/templatedokumen','unit/templatedokumen*']),
        ]);

        // $this->call("OthersTableSeeder");
    }
}
