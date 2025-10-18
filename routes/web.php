<?php

use App\Livewire\Equipment\EquipmentRegistration;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\UserRoles;
use App\Livewire\Settings\UserRegistration;
use App\Livewire\TestPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

// Ruta temporal de debug
Route::get('/debug-auth', function () {
    $user = Auth::user();
    $sessionData = session()->all();
    return [
        'authenticated' => Auth::check(),
        'user_id' => Auth::id(),
        'user' => $user,
        'session_id' => session()->getId(),
        'guard' => config('auth.defaults.guard'),
        'provider' => config('auth.providers.users.model'),
        'session_driver' => config('session.driver'),
        'session_data' => $sessionData,
        'cookies' => request()->cookies->all(),
    ];
})->name('debug.auth');

// Ruta temporal para login automático
Route::get('/auto-login', function () {
    // Buscar el usuario admin
    $user = \App\Models\User::where('usuario', 'admin')->first();

    if (!$user) {
        return 'Usuario admin no encontrado';
    }

    // Login automático
    Auth::login($user, true);

    // Guardar la sesión explícitamente
    session()->save();

    Log::info('Auto-login ejecutado - User ID: ' . Auth::id());
    Log::info('Auto-login - Auth::check(): ' . (Auth::check() ? 'true' : 'false'));
    Log::info('Auto-login - Session ID: ' . session()->getId());

    // Mostrar info de debug en lugar de redirigir
    return [
        'message' => 'Login successful',
        'user_id' => Auth::id(),
        'auth_check' => Auth::check(),
        'session_id' => session()->getId(),
        'user' => Auth::user()->usuario,
        'redirect_url' => route('dashboard'),
    ];
})->name('auto.login');

Route::get('dashboard', function () {
    Log::info('Dashboard - Auth check: ' . (Auth::check() ? 'true' : 'false'));
    Log::info('Dashboard - User ID: ' . Auth::id());
    Log::info('Dashboard - Session ID: ' . session()->getId());
    Log::info('Dashboard - Session data: ' . json_encode(session()->all()));

    if (!Auth::check()) {
        Log::info('Dashboard - User not authenticated, redirecting to login');
        return redirect()->route('login');
    }

    try {
        $view = view('dashboard');
        Log::info('Dashboard view rendered successfully for user: ' . Auth::user()->usuario);
        return $view;
    } catch (\Exception $e) {
        Log::error('Error rendering dashboard: ' . $e->getMessage());
        return response('Error: ' . $e->getMessage(), 500);
    }
})->name('dashboard');

// Test page for login verification
Route::get('test-login', TestPage::class)->middleware(['auth'])->name('test-login');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    Route::get('settings/user-roles', UserRoles::class)->middleware('superuser')->name('settings.user-roles');
    Route::get('settings/user-registration', UserRegistration::class)->middleware('superuser')->name('settings.user-registration');

    // Equipment routes
    Route::get('equipment/register', EquipmentRegistration::class)->name('equipment.register');

    // Employee routes - admins y superusers pueden acceder
    Route::get('employee/register', \App\Livewire\Employee\EmployeeRegistration::class)->name('employee.register');
});

require __DIR__.'/auth.php';
