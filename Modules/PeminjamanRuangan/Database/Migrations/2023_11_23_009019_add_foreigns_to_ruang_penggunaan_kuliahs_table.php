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
        Schema::table('ruang_penggunaan_kuliahs', function (Blueprint $table) {
            $table
                ->foreign('ruang_id')
                ->references('id')
                ->on('ruangs')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('program_studi_id')
                ->references('id')
                ->on('program_studis')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('mata_kuliah_id')
                ->references('id')
                ->on('mata_kuliahs')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('dosen_id')
                ->references('id')
                ->on('pegawai')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruang_penggunaan_kuliahs', function (Blueprint $table) {
            $table->dropForeign(['ruang_id']);
            $table->dropForeign(['program_studi_id']);
            $table->dropForeign(['mata_kuliah_id']);
            $table->dropForeign(['dosen_id']);
        });
    }
};
