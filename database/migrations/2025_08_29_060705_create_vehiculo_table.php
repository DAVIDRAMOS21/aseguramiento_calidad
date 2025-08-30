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
        Schema::create('vehiculo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_motor', 20);
            $table->string('vin', 20);
            $table->unsignedInteger('cilindrada');
            $table->string('placa', 10);
            $table->unsignedInteger('modelo');
            $table->unsignedInteger('id_equipo')->index('id_equipo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculo');
    }
};
