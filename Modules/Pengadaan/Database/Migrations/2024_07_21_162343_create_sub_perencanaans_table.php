<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sub_perencanaans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('kegiatan', 150);
            $table->unsignedBigInteger('metode_pengadaan_id');
            $table->unsignedBigInteger('jenis_pengadaan_id');
            $table->char('satuan', 50);
            $table->integer('volume');
            $table->integer('harga_satuan');
            $table->bigInteger('pagu');
            $table->char('output');
            $table->date('rencana_mulai');
            $table->date('rencana_bayar');
            $table->unsignedBigInteger('perencanaan_id');
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('pic_id');
            $table->unsignedBigInteger('ppk_id');
            $table->bigInteger('pp_id')->nullable();
            $table->timestamps();

            $table->foreign('perencanaan_id')->references('id')->on('perencanaans')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('unit_id')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('pic_id')->references('id')->on('pegawais')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('ppk_id')->references('id')->on('pegawais')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('metode_pengadaan_id')->references('id')->on('metode_pengadaans')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('jenis_pengadaan_id')->references('id')->on('jenis_pengadaans')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sub_perencanaans', function (Blueprint $table) {
            $table->dropForeign(['perencanaan_id']);
            $table->dropForeign(['unit_id']);
            $table->dropForeign(['pic_id']);
            $table->dropForeign(['ppk_id']);
            $table->dropForeign(['metode_pengadaan_id']);
            $table->dropForeign(['jenis_pengadaan_id']);
        });

        Schema::dropIfExists('sub_perencanaans');
    }
};
