<?php

namespace Modules\PeminjamanRuangan\Database\Seeders;

use App\Models\Core\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\PeminjamanRuangan\Entities\Pegawai;
use Modules\PeminjamanRuangan\Entities\Unit;

class PegawaiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Pegawai::create([
            'NIK' => rand(0, 9999999999),
            'tanggal_lahir' => Carbon::now(),
            'nama' => 'Miyako Sakiri',
            'nomor_induk' => rand(0, 9999999999),
            'status' => 'PNS',
            'telepon' => rand(0, 9999999999),
            'alamat' => 'lorem ipsum dolor sit amet',
            'email' => 'test@gmail.com',
            'unit_id' => Unit::first()->id,
            'KK' => rand(0, 9999999999),
            'NPWP' => rand(0, 9999999999),
            'jenis' => 'Dosen',
            'user_id' => User::first()->id
        ]);
    }
}
