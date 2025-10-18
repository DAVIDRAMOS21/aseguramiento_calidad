<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Livewire\Auth\ConfirmPassword;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\VerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', function() {
        // Vista simple sin Livewire, sin cache
        return response(view('login-simple'))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    })->name('login');

    // Login tradicional sin Livewire
    Route::post('login-traditional', function () {
        $credentials = request()->validate([
            'usuario' => 'required|string',
            'password' => 'required|string',
        ]);

        // Obtener usuario manualmente sin Auth::attempt para evitar regeneración de sesión
        $user = \App\Models\User::where('usuario', $credentials['usuario'])->first();

        if ($user && \Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password)) {
            // Obtener el session ID ANTES del login
            $sessionId = session()->getId();

            // Login manual
            Auth::login($user, false);

            // FORZAR que la sesión mantenga el mismo ID
            session()->setId($sessionId);
            session()->save();

            Log::info('Traditional login successful - User ID: ' . Auth::id());
            Log::info('Traditional login - Session ID: ' . session()->getId());
            Log::info('Traditional login - Auth check: ' . (Auth::check() ? 'true' : 'false'));

            // Redirigir al dashboard
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'usuario' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('usuario');
    })->name('login.traditional');

    Route::get('register', Register::class)->name('register');
    Route::get('forgot-password', ForgotPassword::class)->name('password.request');
    Route::get('reset-password/{token}', ResetPassword::class)->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', VerifyEmail::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::get('confirm-password', ConfirmPassword::class)
        ->name('password.confirm');
});

Route::match(['get', 'post'], 'logout', function () {
    Auth::guard('web')->logout();
    
    session()->invalidate();
    session()->regenerateToken();
    
    return redirect()->route('login');
})->middleware(['auth'])->name('logout');
