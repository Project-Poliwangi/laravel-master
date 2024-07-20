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
        Schema::create('gedungs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('kode', 20);
            $table->char('nama', 30);
            $table->char('lokasi', 50);
            $table->char('foto', 100);
            $table->integer('luas');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gedungs');
    }
};
