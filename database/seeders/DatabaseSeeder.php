<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Monitoring\Database\Seeders\MenuModulMonitoringTableSeeder;
use Modules\Monitoring\Database\Seeders\UserModulMonitoringTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CreateAdminUserSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(MenuModulMonitoringTableSeeder::class);
        $this->call(UserModulMonitoringTableSeeder::class);
    }
}
