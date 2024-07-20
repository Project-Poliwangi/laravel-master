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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('NIK', 50);
            $table->date('tanggal_lahir');
            $table->char('nama', 200);
            $table->char('nomor_induk', 20);
            $table->enum('status', [
                'PNS',
                'PPPK',
                'Kontrak',
                'LB',
                'Non Aktif',
                'CPNS',
            ]);
            $table->char('telepon', 13);
            $table->char('alamat', 200);
            $table->char('email', 100);
            $table->unsignedBigInteger('unit_id');
            $table->char('KK');
            $table->char('NPWP');
            $table->enum('jenis', ['Dosen', 'Tendik']);
            $table->unsignedBigInteger('user_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
