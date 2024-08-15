<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryPengadaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_pengadaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengadaan_id');
            $table->unsignedBigInteger('status_lama')->nullable();
            $table->unsignedBigInteger('status_baru');
            $table->string('keterangan')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('status_lama')->references('id')->on('pengadaan_status')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('status_baru')->references('id')->on('pengadaan_status')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('pengadaan_id')->references('id')->on('pengadaan')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_pengadaan');
    }
}
