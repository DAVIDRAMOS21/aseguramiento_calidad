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
        Schema::create('usuario', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombres', 100)->nullable();
            $table->string('apellidos', 100)->nullable();
            $table->string('email', 100)->nullable()->unique();
            $table->string('telefono', 20)->nullable();
            $table->string('dpi', 15)->nullable();
            $table->string('usuario', 50)->unique('usuario');
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_superuser')->default(false);
            $table->string('superuser_username', 100)->nullable()->unique();
            $table->string('superuser_password', 255)->nullable();
            $table->json('roles')->nullable();
            $table->string('password', 100);
            $table->string('remember_token', 100)->nullable();
            $table->dateTime('fecha_commit')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
