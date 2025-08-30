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
        Schema::table('asignacion', function (Blueprint $table) {
            $table->foreign(['id_equipo'], 'asignacion_ibfk_1')->references(['id'])->on('equipo')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_empleado'], 'asignacion_ibfk_2')->references(['id'])->on('empleado')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asignacion', function (Blueprint $table) {
            $table->dropForeign('asignacion_ibfk_1');
            $table->dropForeign('asignacion_ibfk_2');
        });
    }
};
