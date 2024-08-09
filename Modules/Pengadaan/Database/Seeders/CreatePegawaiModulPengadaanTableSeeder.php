<?php

namespace Modules\Pengadaan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Kepegawaian\Entities\Pegawai;

class CreatePegawaiModulPengadaanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Create Direktur
        Pegawai::create([
            'nip' => '198605212015041002',
            'nama' => 'M. Shofiul Amin',
			'username' => 'shofiulamin',
            'jenis_kelamin' => 'L',
        ]);

        // Create Kajur Bisnis dan Informatika
        Pegawai::create([
            'nip' => '197601222021211001',
            'nama' => 'Mohamad Dimyati Ayatullah',
			'username' => 'mohamaddimyati',
            'jenis_kelamin' => 'L',
            'tmp_lahir' => 'Banyuwangi',
        ]);

        // Create Sekjur Bisnis dan Informatika
        Pegawai::create([
            'nip' => '199004192018031001',
            'nama' => 'Junaedi Adi Prasetyo',
			'username' => 'junaediap',
            'jenis_kelamin' => 'L',
            'tmp_lahir' => 'Malang',
        ]);

        // Create Ka. Unit Perpustakaan
        Pegawai::create([
            'nip' => '199203302019031012',
            'nama' => 'Lutfi Hakim',
			'username' => 'lutfihakim',
            'jenis_kelamin' => 'L',
            'tmp_lahir' => 'Banyuwangi',
        ]);

        // Create Admin Perpustakaan
        Pegawai::create([
            'nip' => '197405142001122002',
            'nama' => 'Uri Anjarwati',
			'username' => 'urianjarwati',
            'jenis_kelamin' => 'P',
            'tmp_lahir' => 'Jember',
        ]);

        // Create PP
        Pegawai::create([
            'nip' => '199002242019031007',
            'nama' => 'Agung Nur S',
			'username' => 'agungns',
            'jenis_kelamin' => 'L',
            'tmp_lahir' => 'Jember',
        ]);

        // Create PPK
        Pegawai::create([
            'nip' => '198311052015041001',
            'nama' => 'Devit Suwardiyanto',
			'username' => 'devits',
            'jenis_kelamin' => 'L',
            'tmp_lahir' => 'Malang',
        ]);

        // $this->call("OthersTableSeeder");
    }
}
