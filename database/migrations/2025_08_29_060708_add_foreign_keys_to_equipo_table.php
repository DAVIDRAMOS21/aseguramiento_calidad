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
        Schema::table('equipo', function (Blueprint $table) {
            $table->foreign(['id_marca'], 'equipo_ibfk_1')->references(['id'])->on('marca')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_empleado'], 'equipo_ibfk_2')->references(['id'])->on('empleado')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipo', function (Blueprint $table) {
            $table->dropForeign('equipo_ibfk_1');
            $table->dropForeign('equipo_ibfk_2');
        });
    }
};
