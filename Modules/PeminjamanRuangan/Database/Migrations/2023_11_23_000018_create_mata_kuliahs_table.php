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
        Schema::create('mata_kuliahs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('kode', 10);
            $table->unsignedBigInteger('program_studi_id');
            $table->char('nama', 100);
            $table->enum('jenis', ['Teori', 'Praktikum', 'Teori & Praktikum']);
            $table->integer('sks');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_kuliahs');
    }
};
