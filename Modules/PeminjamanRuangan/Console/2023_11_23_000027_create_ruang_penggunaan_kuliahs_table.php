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
        Schema::create('ruang_penggunaan_kuliahs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ruang_id');
            $table->unsignedBigInteger('program_studi_id');
            $table->unsignedBigInteger('mata_kuliah_id');
            $table->unsignedBigInteger('dosen_id');
            $table->dateTime('jadwal_mulai');
            $table->dateTime('jadwal_akhir');
            $table->char('peminjam_nim');
            $table->dateTime('waktu_pinjam');
            $table->dateTime('waktu_selesai');
            $table->char('foto_selesai', 100);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruang_penggunaan_kuliahs');
    }
};
