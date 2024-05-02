<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealisasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realisasis', function (Blueprint $table) {
            $table->id();
            $table->char('progres');
            $table->bigInteger('realisasi');
            $table->char('laporan_keuangan');
            $table->char('laporan_kegiatan');
            $table->char('ketercapaian_output');
            $table->date('tanggal_kontrak');
            $table->date('tanggal_pembayaran');
            $table->unsignedBigInteger('sub_perencanaan_id');
            $table->timestamps();

            $table->foreign('sub_perencanaan_id')->references('id')->on('sub_perencanaans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('realisasis');
    }
}
