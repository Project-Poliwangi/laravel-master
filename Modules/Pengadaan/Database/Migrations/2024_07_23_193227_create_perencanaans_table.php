<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('perencanaans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('nama', 150);
            $table->char('kode', 100);
            $table->enum('sumber', ['PNP', 'RM', 'Hibah', 'BOPTN', 'CF']);
            $table->integer('revisi');
            $table->integer('tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('perencanaans');
    }
};
