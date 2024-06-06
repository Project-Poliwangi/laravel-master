<?php

namespace Modules\Pengadaan\Database\Seeders;

use App\Models\Core\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class CreateUserModulPengadaanTableSeeder extends Seeder
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
            'name' => 'Ruth Ema Febrita',
			'email' => 'ruthema@gmail.com',
			'username' => 'ruthema',
			'password' => Hash::make('12345678'),
			'unit' => 87,
			'staff' => 4,
			'status' => 1
        ]);

        $role = Role::create(['name' => 'unit']);
        
        $permissions = Permission::where('name','adminlte.darkmode.toggle')
        ->orWhere('name','logout.perform')
        ->orWhere('name','home.index')
        ->orWhere('name','login.show')
        ->pluck('id','id')
        ->all();
   
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);



        $user = User::create([
            'name' => 'Agung Nur S',
			'email' => 'agungns@gmail.com',
			'username' => 'agungns',
			'password' => Hash::make('12345678'),
			'unit' => 88,
			'staff' => 13,
			'status' => 1
        ]);

        $role = Role::create(['name' => 'pengadaan']);
        
        $permissions = Permission::where('name','adminlte.darkmode.toggle')
        ->orWhere('name','logout.perform')
        ->orWhere('name','home.index')
        ->orWhere('name','login.show')
        ->pluck('id','id')
        ->all();
   
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);



        $user = User::create([
            'name' => 'Devit Suwardiyanto',
			'email' => 'devits@gmail.com',
			'username' => 'devits',
			'password' => Hash::make('12345678'),
			'unit' => 13,
			'staff' => 4,
			'status' => 1
        ]);

        $role = Role::create(['name' => 'ppk']);
        
        $permissions = Permission::where('name','adminlte.darkmode.toggle')
        ->orWhere('name','logout.perform')
        ->orWhere('name','home.index')
        ->orWhere('name','login.show')
        ->pluck('id','id')
        ->all();
   
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);



        $user = User::create([
            'name' => 'Sofiul Amin',
			'email' => 'sofiulamin@gmail.com',
			'username' => 'sofiulamin',
			'password' => Hash::make('12345678'),
			'unit' => 0,
			'staff' => 4,
			'status' => 1
        ]);

        $role = Role::create(['name' => 'direktur']);
        
        $permissions = Permission::where('name','adminlte.darkmode.toggle')
        ->orWhere('name','logout.perform')
        ->orWhere('name','home.index')
        ->orWhere('name','login.show')
        ->pluck('id','id')
        ->all();
   
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        // $this->call("OthersTableSeeder");
    }
}
