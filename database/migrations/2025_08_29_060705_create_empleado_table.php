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
        Schema::create('empleado', function (Blueprint $table) {
            $table->increments('id');
            $table->string('primer_nombre', 50);
            $table->string('segundo_nombre', 50);
            $table->string('primer_apellido', 50);
            $table->string('segundo_apellido', 50);
            $table->unsignedInteger('id_usuario')->unique('id_usuario');
            $table->enum('estado', ['activo', 'inactivo', 'vacaciones'])->nullable()->default('activo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleado');
    }
};
