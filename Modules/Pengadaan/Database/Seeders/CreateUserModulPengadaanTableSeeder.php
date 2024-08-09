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

        // Create User dan Role Direktur
        $user = User::create([
            'nip' => '198605212015041002',
            'name' => 'M. Shofiul Amin',
			'email' => 'shofiulamin@gmail.com',
			'username' => 'shofiulamin',
			'password' => Hash::make('12345678'),
			'unit' => 1,
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

        // Create User dan Role Wadir 1
        // $user = User::create([
        //     'nip' => '198304132021211003',
        //     'name' => 'Abdul Rohman',
		// 	'email' => 'adbulrohman@gmail.com',
		// 	'username' => 'abdulrohman',
		// 	'password' => Hash::make('12345678'),
		// 	'unit' => 2,
		// 	'staff' => 4,
		// 	'status' => 1
        // ]);

        // $role = Role::create(['name' => 'wadir1']);
        
        // $permissions = Permission::where('name','adminlte.darkmode.toggle')
        // ->orWhere('name','logout.perform')
        // ->orWhere('name','home.index')
        // ->orWhere('name','login.show')
        // ->pluck('id','id')
        // ->all();
   
        // $role->syncPermissions($permissions);
        // $user->assignRole([$role->id]);

        // Create User dan Role Wadir 2
        // $user = User::create([
        //     'nip' => '198311052015041001',
        //     'name' => 'Devit Suwardiyanto',
		// 	'email' => 'devits@gmail.com',
		// 	'username' => 'devitsuwardiyanto',
		// 	'password' => Hash::make('12345678'),
		// 	'unit' => 3,
		// 	'staff' => 4,
		// 	'status' => 1
        // ]);

        // $role = Role::create(['name' => 'wadir2']);
        
        // $permissions = Permission::where('name','adminlte.darkmode.toggle')
        // ->orWhere('name','logout.perform')
        // ->orWhere('name','home.index')
        // ->orWhere('name','login.show')
        // ->pluck('id','id')
        // ->all();
   
        // $role->syncPermissions($permissions);
        // $user->assignRole([$role->id]);

        // Create User dan Role Wadir 3
        // $user = User::create([
        //     'nip' => '198804042018031001',
        //     'name' => 'Kurniawan Muhammad Nur',
		// 	'email' => 'kurniawanmn@gmail.com',
		// 	'username' => 'kurniawanmuhammadnur',
		// 	'password' => Hash::make('12345678'),
		// 	'unit' => 4,
		// 	'staff' => 4,
		// 	'status' => 1
        // ]);

        // $role = Role::create(['name' => 'wadir3']);
        
        // $permissions = Permission::where('name','adminlte.darkmode.toggle')
        // ->orWhere('name','logout.perform')
        // ->orWhere('name','home.index')
        // ->orWhere('name','login.show')
        // ->pluck('id','id')
        // ->all();
   
        // $role->syncPermissions($permissions);
        // $user->assignRole([$role->id]);

        // Create User dan Role Kajur Bisnis dan Informatika
        $user = User::create([
            'nip' => '197601222021211001',
            'name' => 'Mohamad Dimyati Ayatullah',
			'email' => 'mdimyati@gmail.com',
			'username' => 'mohamaddimyati',
			'password' => Hash::make('12345678'),
			'unit' => 74,
			'staff' => 4,
			'status' => 1
        ]);

        $role = Role::create(['name' => 'kajur']);
        
        $permissions = Permission::where('name','adminlte.darkmode.toggle')
        ->orWhere('name','logout.perform')
        ->orWhere('name','home.index')
        ->orWhere('name','login.show')
        ->pluck('id','id')
        ->all();

        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        // Create User dan Role Ka. Unit Perpustakaan
        $user = User::create([
            'nip' => '199203302019031012',
            'name' => 'Lutfi Hakim',
			'email' => 'lutfihakim@gmail.com',
			'username' => 'lutfihakim',
			'password' => Hash::make('12345678'),
			'unit' => 83,
			'staff' => 4,
			'status' => 1
        ]);

        $role = Role::create(['name' => 'kaunit']);
        
        $permissions = Permission::where('name','adminlte.darkmode.toggle')
        ->orWhere('name','logout.perform')
        ->orWhere('name','home.index')
        ->orWhere('name','login.show')
        ->pluck('id','id')
        ->all();

        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        // Create User dan Role PP
        $user = User::create([
            'nip' => '199002242019031007',
            'name' => 'Agung Nur S',
			'email' => 'agungns@gmail.com',
			'username' => 'agungns',
			'password' => Hash::make('12345678'),
			'unit' => 88,
			'staff' => 13,
			'status' => 1
        ]);

        $role = Role::create(['name' => 'pp']);
        
        $permissions = Permission::where('name','adminlte.darkmode.toggle')
        ->orWhere('name','logout.perform')
        ->orWhere('name','home.index')
        ->orWhere('name','login.show')
        ->pluck('id','id')
        ->all();
   
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        // Create User dan Role PPK
        $user = User::create([
            'nip' => '198311052015041001',
            'name' => 'Devit Suwardiyanto',
			'email' => 'devits@gmail.com',
			'username' => 'devits',
			'password' => Hash::make('12345678'),
			'unit' => 115,
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

        // $this->call("OthersTableSeeder");
    }
}
