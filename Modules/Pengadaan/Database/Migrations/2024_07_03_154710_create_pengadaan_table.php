<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengadaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengadaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subperencanaan_id');
            $table->unsignedBigInteger('status_id');
            $table->string('dokumen_kak')->nullable();
            $table->string('dokumen_hps')->nullable();
            $table->string('dokumen_stock_opname')->nullable();
            $table->string('dokumen_surat_ijin_impor')->nullable();
            $table->string('dokumen_pemilihan_penyedia')->nullable();
            $table->string('dokumen_kontrak')->nullable(); 
            $table->string('dokumen_serah_terima)')->nullable(); 
            $table->timestamps();

            $table->foreign('subperencanaan_id')->references('id')->on('sub_perencanaans')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('status_id')->references('id')->on('pengadaan_status')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengadaan', function (Blueprint $table) {
            $table->dropForeign(['subperencanaan_id']);
            $table->dropForeign(['status_id']);
            });
    }
}
