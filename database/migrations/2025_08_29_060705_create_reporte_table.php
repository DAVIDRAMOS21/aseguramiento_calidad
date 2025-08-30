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
        Schema::create('reporte', function (Blueprint $table) {
            $table->increments('id');
            $table->text('observacion')->nullable();
            $table->unsignedInteger('id_causa')->index('id_causa');
            $table->unsignedInteger('id_equipo')->index('id_equipo');
            $table->unsignedInteger('id_empleado')->index('id_empleado');
            $table->dateTime('fecha_commit')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reporte');
    }
};
