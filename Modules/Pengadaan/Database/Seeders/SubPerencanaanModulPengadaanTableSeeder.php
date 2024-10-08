<?php

namespace Modules\Pengadaan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class SubPerencanaanModulPengadaanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('sub_perencanaans')->insert([
            // bisnis informatika
            [
                'kegiatan' => ' ',
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Unit',
                'volume' => 1,
                'harga_satuan' => 40306000,
                'output' => ' ',
                'rencana_mulai' => '2024-09-01',
                'rencana_bayar' => '2024-09-01',
                'file_hps' => 'file_hps_a1.pdf',
                'file_kak' => 'file_kak_a1.pdf',
                'perencanaan_id' => 1,
                'pic_id' => 74,
                'ppk_id' => 1,
                'jenis' => 'Barang'
            ],
            [
                'kegiatan' => ' ',
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Unit',
                'volume' => 1,
                'harga_satuan' => 27088000,
                'output' => ' ',
                'rencana_mulai' => '2024-06-01',
                'rencana_bayar' => '2024-06-01',
                'file_hps' => 'file_hps_a1.pdf',
                'file_kak' => 'file_kak_a1.pdf',
                'perencanaan_id' => 2,
                'pic_id' => 74,
                'ppk_id' => 1,
                'jenis' => 'Barang'
            ],
            [
                'kegiatan' => ' ',
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Unit',
                'volume' => 1,
                'harga_satuan' => 27087000,
                'output' => ' ',
                'rencana_mulai' => '2024-03-01',
                'rencana_bayar' => '2024-03-01',
                'file_hps' => 'file_hps_a1.pdf',
                'file_kak' => 'file_kak_a1.pdf',
                'perencanaan_id' => 3,
                'pic_id' => 74,
                'ppk_id' => 1,
                'jenis' => 'Barang'
            ],
            [
                'kegiatan' => ' ',
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Unit',
                'volume' => 1,
                'harga_satuan' => 27088000,
                'output' => ' ',
                'rencana_mulai' => '2024-03-01',
                'rencana_bayar' => '2024-03-01',
                'file_hps' => 'file_hps_a1.pdf',
                'file_kak' => 'file_kak_a1.pdf',
                'perencanaan_id' => 4,
                'pic_id' => 74,
                'ppk_id' => 1,
                'jenis' => 'Barang'
            ],
            [
                'kegiatan' => ' ',
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Unit',
                'volume' => 1,
                'harga_satuan' => 18207000,
                'output' => ' ',
                'rencana_mulai' => '2024-06-01',
                'rencana_bayar' => '2024-06-01',
                'file_hps' => 'file_hps_a1.pdf',
                'file_kak' => 'file_kak_a1.pdf',
                'perencanaan_id' => 5,
                'pic_id' => 74,
                'ppk_id' => 1,
                'jenis' => 'Barang'
            ],
            [
                'kegiatan' => ' ',
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Unit',
                'volume' => 1,
                'harga_satuan' => 20000000,
                'output' => ' ',
                'rencana_mulai' => '2024-10-01',
                'rencana_bayar' => '2024-10-01',
                'file_hps' => 'file_hps_a1.pdf',
                'file_kak' => 'file_kak_a1.pdf',
                'perencanaan_id' => 6,
                'pic_id' => 74,
                'ppk_id' => 1,
                'jenis' => 'Barang'
            ],
            [
                'kegiatan' => ' ',
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Unit',
                'volume' => 1,
                'harga_satuan' =>  27271000,
                'output' => ' ',
                'rencana_mulai' => '2024-07-01',
                'rencana_bayar' => '2024-07-01',
                'file_hps' => 'file_hps_a1.pdf',
                'file_kak' => 'file_kak_a1.pdf',
                'perencanaan_id' => 7,
                'pic_id' => 74,
                'ppk_id' => 1,
                'jenis' => 'Barang'
            ],

            // mesin 8 - 18
            [
                'kegiatan' => ' ',
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Unit',
                'volume' => 1,
                'harga_satuan' =>  4000000,
                'output' => ' ',
                'rencana_mulai' => '2024-03-01',
                'rencana_bayar' => '2024-03-01',
                'file_hps' => 'file_hps_a1.pdf',
                'file_kak' => 'file_kak_a1.pdf',
                'perencanaan_id' => 8,
                'pic_id' => 75,
                'ppk_id' => 1,
                'jenis' => 'Barang'
            ],
            [
                'kegiatan' => ' ',
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Unit',
                'volume' => 1,
                'harga_satuan' =>  4000000,
                'output' => ' ',
                'rencana_mulai' => '2024-04-01',
                'rencana_bayar' => '2024-04-01',
                'file_hps' => 'file_hps_a1.pdf',
                'file_kak' => 'file_kak_a1.pdf',
                'perencanaan_id' => 8,
                'pic_id' => 75,
                'ppk_id' => 1,
                'jenis' => 'Barang'
            ],
            [
                'kegiatan' => ' ',
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Unit',
                'volume' => 1,
                'harga_satuan' =>  4000000,
                'output' => ' ',
                'rencana_mulai' => '2024-05-01',
                'rencana_bayar' => '2024-05-01',
                'file_hps' => 'file_hps_a1.pdf',
                'file_kak' => 'file_kak_a1.pdf',
                'perencanaan_id' => 8,
                'pic_id' => 75,
                'ppk_id' => 1,
                'jenis' => 'Barang'
            ],
            [
                'kegiatan' => ' ',
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Unit',
                'volume' => 1,
                'harga_satuan' =>  4000000,
                'output' => ' ',
                'rencana_mulai' => '2024-07-01',
                'rencana_bayar' => '2024-07-01',
                'file_hps' => 'file_hps_a1.pdf',
                'file_kak' => 'file_kak_a1.pdf',
                'perencanaan_id' => 8,
                'pic_id' => 75,
                'ppk_id' => 1,
                'jenis' => 'Barang'
            ],
            [
                'kegiatan' => ' ',
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Unit',
                'volume' => 1,
                'harga_satuan' =>  4000000,
                'output' => ' ',
                'rencana_mulai' => '2024-09-01',
                'rencana_bayar' => '2024-09-01',
                'file_hps' => 'file_hps_a1.pdf',
                'file_kak' => 'file_kak_a1.pdf',
                'perencanaan_id' => 8,
                'pic_id' => 75,
                'ppk_id' => 1,
                'jenis' => 'Barang'
            ],
            [
                'kegiatan' => ' ',
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Unit',
                'volume' => 1,
                'harga_satuan' =>  4000000,
                'output' => ' ',
                'rencana_mulai' => '2024-11-01',
                'rencana_bayar' => '2024-11-01',
                'file_hps' => 'file_hps_a1.pdf',
                'file_kak' => 'file_kak_a1.pdf',
                'perencanaan_id' => 8,
                'pic_id' => 75,
                'ppk_id' => 1,
                'jenis' => 'Barang'
            ],

            [
                'kegiatan' => ' ',
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Unit',
                'volume' => 1,
                'harga_satuan' =>  10000000,
                'output' => ' ',
                'rencana_mulai' => '2024-03-01',
                'rencana_bayar' => '2024-03-01',
                'file_hps' => 'file_hps_a1.pdf',
                'file_kak' => 'file_kak_a1.pdf',
                'perencanaan_id' => 10,
                'pic_id' => 75,
                'ppk_id' => 1,
                'jenis' => 'Barang'
            ],
            [
                'kegiatan' => ' ',
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Unit',
                'volume' => 1,
                'harga_satuan' =>  10000000,
                'output' => ' ',
                'rencana_mulai' => '2024-04-01',
                'rencana_bayar' => '2024-04-01',
                'file_hps' => 'file_hps_a1.pdf',
                'file_kak' => 'file_kak_a1.pdf',
                'perencanaan_id' => 10,
                'pic_id' => 75,
                'ppk_id' => 1,
                'jenis' => 'Barang'
            ],

            [
                'kegiatan' => ' ',
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Unit',
                'volume' => 1,
                'harga_satuan' =>  10000000,
                'output' => ' ',
                'rencana_mulai' => '2024-03-01',
                'rencana_bayar' => '2024-03-01',
                'file_hps' => 'file_hps_a1.pdf',
                'file_kak' => 'file_kak_a1.pdf',
                'perencanaan_id' => 11,
                'pic_id' => 75,
                'ppk_id' => 1,
                'jenis' => 'Barang'
            ],
            [
                'kegiatan' => ' ',
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Unit',
                'volume' => 1,
                'harga_satuan' =>  10000000,
                'output' => ' ',
                'rencana_mulai' => '2024-04-01',
                'rencana_bayar' => '2024-04-01',
                'file_hps' => 'file_hps_a1.pdf',
                'file_kak' => 'file_kak_a1.pdf',
                'perencanaan_id' => 11,
                'pic_id' => 75,
                'ppk_id' => 1,
                'jenis' => 'Barang'
            ],

            [
                'kegiatan' => ' ',
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Unit',
                'volume' => 1,
                'harga_satuan' =>  64100000,
                'output' => ' ',
                'rencana_mulai' => '2024-07-01',
                'rencana_bayar' => '2024-07-01',
                'file_hps' => 'file_hps_a1.pdf',
                'file_kak' => 'file_kak_a1.pdf',
                'perencanaan_id' => 12,
                'pic_id' => 75,
                'ppk_id' => 1,
                'jenis' => 'Barang'
            ],
        ]);

        // $this->call("OthersTableSeeder");
    }
}
