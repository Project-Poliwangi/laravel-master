<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJenisPengadaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_pengadaans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_jenis', 150);

            $table->timestamps();
        });

        // Insert default values
        DB::table('jenis_pengadaans')->insert([
            ['nama_jenis' => 'Barang'],
            ['nama_jenis' => 'Jasa Konsultansi'],
            ['nama_jenis' => 'Operasional'],
            ['nama_jenis' => 'Pekerjaan Konstruksi']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jenis_pengadaans');
    }
}
