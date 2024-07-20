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
        Schema::table('mata_kuliahs', function (Blueprint $table) {
            $table
                ->foreign('program_studi_id')
                ->references('id')
                ->on('program_studis')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mata_kuliahs', function (Blueprint $table) {
            $table->dropForeign(['program_studi_id']);
        });
    }
};
