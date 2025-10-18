<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public string $nombres = '';
    
    public string $apellidos = '';
    
    public string $email = '';
    
    public string $telefono = '';
    
    public string $dpi = '';

    public string $usuario = '';

    public string $password = '';

    public string $password_confirmation = '';

    public bool $is_admin = false;

    public string $successMessage = '';

    public string $errorMessage = '';

    /**
     * Handle an incoming registration request.
     */
    public function register()
    {
        $this->successMessage = '';
        $this->errorMessage = '';

        try {
            $validated = $this->validate([
                'nombres' => ['required', 'string', 'max:255'],
                'apellidos' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:usuario,email'],
                'telefono' => ['required', 'string', 'max:20'],
                'dpi' => ['nullable', 'string', 'max:20'],
                'usuario' => ['required', 'string', 'max:50', 'unique:usuario,usuario'],
                'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
                'is_admin' => ['boolean'],
            ]);

            $user = User::create([
                'nombres' => $validated['nombres'],
                'apellidos' => $validated['apellidos'],
                'email' => $validated['email'],
                'telefono' => $validated['telefono'],
                'dpi' => $validated['dpi'],
                'usuario' => $validated['usuario'],
                'password' => Hash::make($validated['password']),
                'is_admin' => $validated['is_admin'] ?? false,
                'fecha_commit' => now(),
            ]);

            event(new Registered($user));

            Auth::login($user);

            $this->successMessage = 'Usuario registrado exitosamente. Redirigiendo...';

            // Regenerar la sesión
            request()->session()->regenerate();

            // Redirigir después de mostrar el mensaje
            session()->flash('success', 'Usuario registrado exitosamente');

            Log::info('Register: Dispatching redirect event to: ' . route('dashboard'));
            $this->dispatch('redirect', url: route('dashboard'));

        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = [];
            foreach ($e->errors() as $field => $messages) {
                $errors = array_merge($errors, $messages);
            }
            $this->errorMessage = 'Error de validación: ' . implode(', ', $errors);
        } catch (\Exception $e) {
            $this->errorMessage = 'Error al registrar el usuario: ' . $e->getMessage();
        }
    }
}
