<?php

namespace Modules\Pengadaan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PerencanaanModulPengadaanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('perencanaans')->insert([
            // 
            [
                'id' => 1,
                'nama' => 'Belanja Pemeliharaan Gedung dan Bangunan Lainnya',
                'kode' => '523119',
                'sumber' => 'RM',
                'pagu' => 741000000,
                'revisi' => 1,
                'tahun' => 2024
            ],
            [
                'id' => 2,
                'nama' => 'Belanja Barang Non Operasional Lainnya',
                'kode' => '521219',
                'sumber' => 'RM',
                'pagu' => 123456789,
                'revisi' => 1,
                'tahun' => 2024
            ],
            [
                'id' => 2,
                'nama' => 'Belanja Barang Persediaan Konsumsi',
                'kode' => '000235',
                'sumber' => 'RM',
                'pagu' => 123456789,
                'revisi' => 1,
                'tahun' => 2024
            ],
            [
                'id' => 3,
                'nama' => 'Belanja Modal Lainnya',
                'kode' => '000236',
                'sumber' => 'RM',
                'pagu' => 123456789,
                'revisi' => 1,
                'tahun' => 2024
            ],
            [
                'id' => 4,
                'nama' => 'Belanja Barang Operasional Lainnya',
                'kode' => '000237',
                'sumber' => 'PNBP',
                'pagu' => 123456789,
                'revisi' => 1,
                'tahun' => 2024
            ],
            [
                'id' => 5,
                'nama' => 'Belanja Jasa Profesi',
                'kode' => '000238',
                'sumber' => 'PNBP',
                'pagu' => 123456789,
                'revisi' => 1,
                'tahun' => 2024
            ],
        ]);

        // $this->call("OthersTableSeeder");
    }
}
