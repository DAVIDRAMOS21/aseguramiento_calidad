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
        Schema::create('equipo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identificador', 20)->nullable();
            $table->string('nombre', 50);
            $table->unsignedInteger('id_marca')->index('id_marca');
            $table->string('color', 50);
            $table->decimal('valor', 10);
            $table->string('serie', 50);
            $table->text('extras')->nullable();
            $table->enum('tipo_alimentacion', ['110v', '220v', 'diesel', 'regular', 'super', 'bateria', 'ninguna'])->nullable()->default('ninguna');
            $table->unsignedInteger('id_empleado')->nullable()->index('id_empleado');
            $table->enum('estado', ['activo', 'inactivo', 'mantenimiento', 'suspendido'])->nullable()->default('activo');
            $table->dateTime('fecha_commit')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipo');
    }
};
