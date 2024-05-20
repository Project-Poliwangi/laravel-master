<?php

namespace Modules\Kepegawaian\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Core\Menu;

class MenuModulKepegawaianTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Menu::where('modul','Kepegawaian')->delete();
        $menu = Menu::create([
            'id' => 7,
            'modul' => 'Kepegawaian',
            'label' => 'Kepegawaian',
            'url' => '',
            'can' => serialize(['admin']),
            'icon' => 'far fa-circle',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['kepegawaian']),
        ]);
        if($menu){
            Menu::create([
                'id' => 8,
                'modul' => 'Kepegawaian',
                'label' => 'Master Pegawai',
                'url' => 'kepegawaian/pegawai',
                'can' => serialize(['admin']),
                'icon' => 'far fa-circle',
                'urut' => 1,
                'parent_id' => 7,
                'active' => serialize(['kepegawaian/pegawai','kepegawaian/pegawai*']),
            ]);
        }
    }
}
