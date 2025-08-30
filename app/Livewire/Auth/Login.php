<?php

namespace App\Livewire\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
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

    public string $successMessage = '';

    public string $errorMessage = '';

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->successMessage = '';
        $this->errorMessage = '';

        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['usuario' => $this->usuario, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            $this->errorMessage = 'Las credenciales no coinciden con nuestros registros. Por favor verifica tu usuario y contraseña.';
            
            throw ValidationException::withMessages([
                'usuario' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();
        
        session()->flash('success', 'Bienvenido de vuelta');
        
        // Redireccionar al dashboard después del login exitoso
        $this->redirectRoute('dashboard', navigate: true);
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
