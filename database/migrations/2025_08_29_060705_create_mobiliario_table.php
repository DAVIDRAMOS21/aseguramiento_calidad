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
        Schema::create('mobiliario', function (Blueprint $table) {
            $table->increments('id');
            $table->string('material', 50);
            $table->float('altura', 8);
            $table->float('ancho', 8);
            $table->float('profundidad', 8);
            $table->unsignedInteger('cantidad_piezas')->nullable()->default(1);
            $table->unsignedInteger('id_equipo')->index('id_equipo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobiliario');
    }
};
