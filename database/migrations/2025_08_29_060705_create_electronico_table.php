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
        Schema::create('electronico', function (Blueprint $table) {
            $table->increments('id');
            $table->string('imei', 20)->nullable();
            $table->string('sistema_operativo', 20)->nullable();
            $table->enum('conectividad', ['bluetooth', 'wifi', 'gsm', 'nfc', 'bluetooth_wifi', 'bluetooth_gsm', 'bluetooth_nfc', 'wifi_gsm', 'wifi_nfc', 'gsm_nfc', 'bluetooth_wifi_gsm', 'bluetooth_wifi_nfc', 'bluetooth_gsm_nfc', 'wifi_gsm_nfc', 'bluetooth_wifi_gsm_nfc', 'ninguno'])->nullable()->default('ninguno');
            $table->enum('operador', ['starlink', 'claro', 'tigo', 'comnet', 'verasat', 'telecom', 'ninguno'])->nullable()->default('ninguno');
            $table->unsignedInteger('id_equipo')->index('id_equipo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electronico');
    }
};
