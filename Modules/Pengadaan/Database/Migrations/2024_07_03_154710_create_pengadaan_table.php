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
            $table->string('nomor_surat');
            $table->unsignedBigInteger('jenis_pengadaan_id');
            $table->decimal('total_biaya', 15, 2);
            $table->string('dokumen_kak')->nullable();
            $table->string('dokumen_hps')->nullable();
            $table->string('dokumen_stock_opname')->nullable();
            $table->string('dokumen_surat_ijin_impor')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('pengadaan_status')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('jenis_pengadaan_id')->references('id')->on('jenis_pengadaans')->onUpdate('CASCADE')->onDelete('CASCADE');
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
            $table->dropForeign(['jenis_pengadaan_id']);
            $table->dropForeign(['status_id']);
            });
    }
}
