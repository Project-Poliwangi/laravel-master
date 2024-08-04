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
        Schema::create('jadwal_kuliahs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('mata_kuliah_id');
            $table->integer('semester');
            $table->string('kelas');
            $table->foreignId('program_studi_id');
            $table->foreignId('dosen_id');
            $table->enum('hari', ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->foreignId('ruang_id');
            $table->text('description')->nullable();
            $table->foreign('mata_kuliah_id')->references('id')->on('mata_kuliahs')->onDelete('cascade');
            $table->foreign('program_studi_id')->references('id')->on('program_studis')->onDelete('cascade');
            $table->foreign('dosen_id')->references('id')->on('pegawai')->onDelete('cascade');
            $table->foreign('ruang_id')->references('id')->on('ruangs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_kuliahs');
    }
};
