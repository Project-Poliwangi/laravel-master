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
                'nama' => 'Belanja Keperluan Perkantoran',
                'kode' => '521111',
                'sumber' => 'RM',
                'revisi' => 7,
                'tahun' => 2024
            ],
            [
                'id' => 2,
                'nama' => 'Belanja Penambahan Nilai Gedung dan Bangunan',
                'kode' => '521119',
                'sumber' => 'PNP',
                'revisi' => 7,
                'tahun' => 2024
            ],
            [
                'id' => 3,
                'nama' => 'Belanja Bahan',
                'kode' => '521211',
                'sumber' => 'RM',
                'revisi' => 7,
                'tahun' => 2024
            ],
            [
                'id' => 4,
                'nama' => 'Belanja Barang Non Operasional Lainnya',
                'kode' => '521219',
                'sumber' => 'RM',
                'revisi' => 7,
                'tahun' => 2024
            ],
            [
                'id' => 5,
                'nama' => 'Belanja Barang Persediaan Barang Konsumsi',
                'kode' => '521811',
                'sumber' => 'RM',
                'revisi' => 7,
                'tahun' => 2024
            ],
            [
                'id' => 6,
                'nama' => 'Belanja Jasa Lainnya',
                'kode' => '522191',
                'sumber' => 'RM',
                'revisi' => 7,
                'tahun' => 2024
            ],
            [
                'id' => 7,
                'nama' => 'Belanja Pemeliharaan Gedung dan Bangunan',
                'kode' => '523111',
                'sumber' => 'RM',
                'revisi' => 7,
                'tahun' => 2024
            ],
            [
                'id' => 8,
                'nama' => 'Belanja Pemeliharaan Gedung dan Bangunan Lainnya',
                'kode' => '523119',
                'sumber' => 'RM',
                'revisi' => 7,
                'tahun' => 2024
            ],
            [
                'id' => 9,
                'nama' => 'Belanja Modal Peralatan dan Mesin',
                'kode' => '532111',
                'sumber' => 'PNP',
                'revisi' => 7,
                'tahun' => 2024
            ],
            [
                'id' => 10,
                'nama' => 'Belanja Penambahan Nilai Peralatan dan Mesin',
                'kode' => '532121',
                'sumber' => 'PNP',
                'revisi' => 7,
                'tahun' => 2024
            ],
            [
                'id' => 11,
                'nama' => 'Belanja Modal Gedung dan Bangunan',
                'kode' => '533111',
                'sumber' => 'PNP',
                'revisi' => 7,
                'tahun' => 2024
            ],
            [
                'id' => 12,
                'nama' => 'Belanja Modal Pembebasan Tanah',
                'kode' => '533112',
                'sumber' => 'PNP',
                'revisi' => 7,
                'tahun' => 2024
            ],
            [
                'id' => 13,
                'nama' => 'Belanja Modal Perencanaan dan Pengawasan Gedung dan Bangunan',
                'kode' => '533115',
                'sumber' => 'PNP',
                'revisi' => 7,
                'tahun' => 2024
            ],
            [
                'id' => 14,
                'nama' => 'Belanja Penambahan Nilai Gedung dan Bangunan',
                'kode' => '533121',
                'sumber' => 'PNP',
                'revisi' => 7,
                'tahun' => 2024
            ],
            [
                'id' => 15,
                'nama' => 'Belanja Penambahan Nilai Gedung dan Bangunan',
                'kode' => '533121',
                'sumber' => 'RM',
                'revisi' => 7,
                'tahun' => 2024
            ],
            [
                'id' => 16,
                'nama' => 'Belanja Modal Lainnya',
                'kode' => '536111',
                'sumber' => 'RM',
                'revisi' => 7,
                'tahun' => 2024
            ],
            [
                'id' => 17,
                'nama' => 'Belanja Modal Lainnya',
                'kode' => '536111',
                'sumber' => 'PNP',
                'revisi' => 7,
                'tahun' => 2024
            ],   
        ]);

        // $this->call("OthersTableSeeder");
    }
}
