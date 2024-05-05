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
        Schema::create('pejabats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('jabatan', 20);
            $table->date('mulai');
            $table->date('selesai');
            $table->char('SK', 150);
            $table->unsignedBigInteger('pegawai_id');
            $table->unsignedBigInteger('unit_id');
            $table->enum('status', ['Aktif', 'Non Aktif'])->default('Aktif');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pejabats');
    }
};
