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
            $table->string('nomor_surat');
            $table->decimal('total_biaya', 15, 2);
            $table->string('dokumen_kak')->nullable();
            $table->string('dokumen_hps')->nullable();
            $table->string('dokumen_stock_opname')->nullable();
            $table->string('dokumen_surat_ijin_impor')->nullable();
            $table->string('dokumen_pemilihan_penyedia')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('pengadaan_status')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('subperencanaan_id')->references('id')->on('sub_perencanaans')->onUpdate('CASCADE')->onDelete('CASCADE');
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
