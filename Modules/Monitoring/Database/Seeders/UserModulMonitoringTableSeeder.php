<?php

namespace Modules\Monitoring\Database\Seeders;

use App\Models\Core\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserModulMonitoringTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        \Artisan::call('permission:create-permission-routes');

        $user = User::create([
            'name' => 'Perencanaan',
			'email' => 'perencanaan@gmail.com',
			'username' => 'perencanaan',
			'password' => Hash::make('12345678'),
			'unit' => 72,
			'staff' => 22,
			'status' => 2
        ]);
        
  

        $role = Role::create(['name' => 'perencanaan']);
        
        $permissions = Permission::where('name','adminlte.darkmode.toggle')
        ->orWhere('name','logout.perform')
        ->orWhere('name','home.index')
        ->orWhere('name','login.show')
        ->orWhere('name','perencanaan.index')
        ->pluck('id','id')
        ->all();
   
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
