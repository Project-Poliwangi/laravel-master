<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengadaanStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengadaan_status', function (Blueprint $table) {
            $table->id();
            $table->string('nama_status');
            $table->timestamps();
        });

        // Insert default values
        DB::table('pengadaan_status')->insert([
            ['status' => 'Pra dipa'],
            ['status' => 'Pemenuhan Dokumen'],
            ['status' => 'Pemilihan Penyedia'],
            ['status' => 'Kontrak'],
            ['status' => 'Serah Terima']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengadaan_status');
    }
}
