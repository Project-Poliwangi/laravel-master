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
        Schema::create('ruang_pemesanan_umums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ruang_id');
            $table->char('nama_peminjam', 30);
            $table->char('no_induk_peminjam', 20);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruang_pemesanan_umums');
    }
};
