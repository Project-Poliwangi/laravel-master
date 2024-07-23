<?php

namespace Modules\PeminjamanRuangan\Database\Seeders;

use App\Models\Core\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthenticationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $user = User::create([
            'name' => 'Pengelola Ruangan',
			'email' => 'pengelola@gmail.com',
			'username' => 'pengelola',
			'password' => Hash::make('12345678'),
			'unit' => 0,
			'staff' => 0,
			'status' => 2
        ]);
        $role = Role::create(['name' => 'pengelola-ruangan']);
        $permissions = Permission::whereIn('name', [
            'adminlte.darkmode.toggle',
            'logout.perform',
            'home.index',
            'login.show',
            'penjadwalan',
            'mata-kuliah.edit', 'mata-kuliah.update', 'mata-kuliah.delete', 'mata-kuliah.store', 'mata-kuliah.create', 'mata-kuliah',
            'ruang.edit', 'ruang.update', 'ruang.delete', 'ruang.store', 'ruang.create', 'ruang',
            'gedung.edit', 'gedung.update', 'gedung.delete', 'gedung.store', 'gedung.create', 'gedung',
        ])->pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        $user = User::create([
            'name' => 'Peminjam',
			'email' => 'peminjam@gmail.com',
			'username' => 'peminjam',
			'password' => Hash::make('12345678'),
			'unit' => 0,
			'staff' => 0,
			'status' => 2
        ]);
        $role = Role::create(['name' => 'peminjam']);
        $permissions = Permission::whereIn('name', [
            'adminlte.darkmode.toggle',
            'logout.perform',
            'home.index',
            'login.show',
            'ruang.terpakai',
            'ruang.tersedia',
            'ruang.check',
            'ruang.check-kode',
        ])->pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }

    public function createPermissions()
    {

    }
}
