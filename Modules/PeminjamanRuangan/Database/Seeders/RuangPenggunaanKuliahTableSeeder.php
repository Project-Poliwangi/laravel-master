<?php

namespace Modules\PeminjamanRuangan\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\PeminjamanRuangan\Entities\MataKuliah;
use Modules\PeminjamanRuangan\Entities\Pegawai;
use Modules\PeminjamanRuangan\Entities\ProgramStudi;
use Modules\PeminjamanRuangan\Entities\Ruang;
use Modules\PeminjamanRuangan\Entities\RuangPenggunaanKuliah;

class RuangPenggunaanKuliahTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        RuangPenggunaanKuliah::create([
            'id' => 1,
            'ruang_id' => Ruang::first()->id,
            'program_studi_id' => ProgramStudi::first()->id,
            'mata_kuliah_id' => MataKuliah::first()->id,
            'dosen_id' => Pegawai::first()->id,
            'jadwal_mulai' => Carbon::now(),
            'jadwal_akhir' => Carbon::now(),
            'peminjam_nim' => rand(0, 9999999999),
            'waktu_pinjam' => Carbon::now(),
            'waktu_selesai' => Carbon::now(),
            'foto_selesai' => 'test.png'
        ]);
    }
}
