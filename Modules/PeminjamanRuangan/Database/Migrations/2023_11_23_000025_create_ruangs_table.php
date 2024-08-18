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
        Schema::create('ruangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('gedung_id');
            $table->char('kode_bmn', 20)->nullable();
            $table->char('kode_qr', 150)->nullable();
            $table->char('nama', 30);
            $table->integer('luas')->nullable();
            $table->integer('kapasitas')->nullable();
            $table->integer('lantai')->nullable();
            $table->char('foto', 100)->nullable();
            $table->enum('jenis', [
                'Interaktif Kelas',
                'Classical Kelas',
                'Ruang Kelas',
                'Ruang Laboratorium',
                'Ruang Kerja',
                'Ruang Rapat',
                'Fasilitas OlahRaga',
                'Aula',
            ])->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruangs');
    }
};
