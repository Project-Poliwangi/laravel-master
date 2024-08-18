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
            $table->char('NIK', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->char('nama', 200);
            $table->char('nomor_induk', 20)->nullable();
            $table->enum('status', [
                'PNS',
                'PPPK',
                'Kontrak',
                'LB',
                'Non Aktif',
                'CPNS',
            ])->nullable();
            $table->char('telepon', 13)->nullable();
            $table->char('alamat', 200)->nullable();
            $table->char('email', 100)->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->char('KK')->nullable();
            $table->char('NPWP')->nullable();
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
