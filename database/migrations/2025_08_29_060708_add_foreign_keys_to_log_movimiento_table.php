<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('log_movimiento', function (Blueprint $table) {
            $table->foreign(['id_usuario'], 'log_movimiento_ibfk_1')->references(['id'])->on('usuario')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('log_movimiento', function (Blueprint $table) {
            $table->dropForeign('log_movimiento_ibfk_1');
        });
    }
};
