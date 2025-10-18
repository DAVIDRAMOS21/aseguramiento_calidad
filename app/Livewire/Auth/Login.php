<?php

namespace App\Livewire\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Login extends Component
{
    #[Validate('required|string')]
    public string $usuario = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    public string $errorMessage = '';

    public string $successMessage = '';

    /**
     * Handle an incoming authentication request.
     */
    public function login()
    {
        $this->errorMessage = '';
        $this->successMessage = '';

        $this->validate();

        $this->ensureIsNotRateLimited();

        Log::info('Intentando login con usuario: ' . $this->usuario);
        
        if (! Auth::attempt(['usuario' => $this->usuario, 'password' => $this->password], $this->remember)) {
            Log::error('Login fallido para usuario: ' . $this->usuario);
            RateLimiter::hit($this->throttleKey());

            $this->errorMessage = 'Las credenciales no coinciden con nuestros registros. Por favor verifica tu usuario y contraseña.';
            
            throw ValidationException::withMessages([
                'usuario' => __('auth.failed'),
            ]);
        }

        Log::info('Login exitoso para usuario: ' . $this->usuario);
        Log::info('Usuario autenticado ID: ' . Auth::id());

        RateLimiter::clear($this->throttleKey());

        Log::info('Session ID after login: ' . Session::getId());

        // Mensaje de éxito
        session()->flash('status', 'Has iniciado sesión correctamente. ¡Bienvenido!');

        Log::info('Dispatching JavaScript redirect to dashboard');

        // Dispatch evento para redirección JavaScript
        $this->dispatch('login-success', url: route('dashboard'));
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        $this->errorMessage = "Demasiados intentos de inicio de sesión. Por favor espera " . ceil($seconds / 60) . " minuto(s) antes de intentar nuevamente.";

        throw ValidationException::withMessages([
            'usuario' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->usuario).'|'.request()->ip());
    }
}
