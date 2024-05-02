<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubPerencanaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_perencanaans', function (Blueprint $table) {
            $table->id();
            $table->string('kegiatan');
            $table->integer('volume');
            $table->string('satuan');
            $table->integer('harga_satuan');
            $table->string('output');
            $table->date('rencana_mulai');
            $table->date('rencana_bayar');
            $table->string('file_hps');
            $table->string('file_kak');
            $table->string('pic_id');
            $table->string('ppk_id');
            $table->unsignedBigInteger('perencanaan_id');
            $table->timestamps();

            $table->foreign('perencanaan_id')->references('id')->on('perencanaans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_perencanaans');
    }
}
