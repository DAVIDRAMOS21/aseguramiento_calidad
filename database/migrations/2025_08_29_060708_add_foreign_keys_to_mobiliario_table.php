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
        Schema::table('mobiliario', function (Blueprint $table) {
            $table->foreign(['id_equipo'], 'mobiliario_ibfk_1')->references(['id'])->on('equipo')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mobiliario', function (Blueprint $table) {
            $table->dropForeign('mobiliario_ibfk_1');
        });
    }
};
