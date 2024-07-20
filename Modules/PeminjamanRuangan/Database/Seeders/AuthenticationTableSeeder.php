<?php

namespace Modules\PeminjamanRuangan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
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

        Role::create(['name' => 'pengelola-ruangan']);
    }

    public function createPermissions()
    {

    }
}
