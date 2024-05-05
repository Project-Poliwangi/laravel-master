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
        Schema::create('pangkat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('pangkat', 20);
            $table->char('golongan', 10);
            $table->date('mulai');
            $table->char('SK', 150);
            $table->unsignedBigInteger('pegawai_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pangkat');
    }
};
