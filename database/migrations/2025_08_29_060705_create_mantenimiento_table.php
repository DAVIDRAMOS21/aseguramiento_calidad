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
        Schema::create('mantenimiento', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_equipo')->index('id_equipo');
            $table->dateTime('fecha');
            $table->string('tipo', 20);
            $table->text('descripcion')->nullable();
            $table->decimal('costo', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimiento');
    }
};
