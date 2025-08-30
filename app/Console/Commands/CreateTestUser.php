<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateTestUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-test-user {usuario} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear un usuario de prueba para el sistema';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $usuario = $this->argument('usuario');
        $password = $this->argument('password');

        // Verificar si el usuario ya existe
        if (User::where('usuario', $usuario)->exists()) {
            $this->error("El usuario '{$usuario}' ya existe.");
            return;
        }

        // Crear el usuario
        $user = User::create([
            'usuario' => $usuario,
            'password' => Hash::make($password),
            'is_admin' => true,
        ]);

        $this->info("Usuario '{$usuario}' creado exitosamente con ID: {$user->id}");
    }
}
