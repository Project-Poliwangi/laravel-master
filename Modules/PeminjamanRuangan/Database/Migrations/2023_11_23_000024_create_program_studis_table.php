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
        Schema::create('program_studis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('jurusan_id');
            $table->char('nama', 100);
            $table->char('singkatan', 10);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_studis');
    }
};
