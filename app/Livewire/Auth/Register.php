<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public string $usuario = '';

    public string $password = '';

    public string $password_confirmation = '';

    public bool $is_admin = false;

    public string $successMessage = '';

    public string $errorMessage = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $this->successMessage = '';
        $this->errorMessage = '';

        try {
            $validated = $this->validate([
                'usuario' => ['required', 'string', 'max:50', 'unique:usuario'],
                'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
                'is_admin' => ['boolean'],
            ]);

            $user = User::create([
                'usuario' => $validated['usuario'],
                'password' => Hash::make($validated['password']),
                'is_admin' => $validated['is_admin'] ?? false,
                'fecha_commit' => now(),
            ]);

            event(new Registered($user));

            Auth::login($user);

            $this->successMessage = 'Usuario registrado exitosamente. Redirigiendo...';
            
            // Esperar un momento para mostrar el mensaje antes de redirigir
            $this->dispatch('$refresh');
            
            // Redirigir después de mostrar el mensaje
            session()->flash('success', 'Usuario registrado exitosamente');
            $this->redirect(route('dashboard', absolute: false), navigate: true);

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
