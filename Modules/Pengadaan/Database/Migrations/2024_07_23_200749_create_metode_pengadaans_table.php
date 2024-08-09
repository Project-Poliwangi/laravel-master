<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetodePengadaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metode_pengadaans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_metode', 150);
            $table->timestamps();
        });

        // Insert default values
        DB::table('metode_pengadaans')->insert([
            ['nama_metode' => 'Swakelola'],
            ['nama_metode' => 'Pengadaan Langsung'],
            ['nama_metode' => 'E-purchasing'],
            ['nama_metode' => 'Tender'],
            ['nama_metode' => 'Seleksi'],
            ['nama_metode' => 'Penunjukan Langsung']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metode_pengadaans');
    }
}
