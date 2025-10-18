<div class="space-y-6">
    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <!-- Formulario de Login -->
    <form method="POST" action="{{ route('login.traditional') }}" class="space-y-6">
        @csrf

        <div class="space-y-2">
            <label for="usuario" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Usuario</label>
            <input
                type="text"
                name="usuario"
                id="usuario"
                required
                autofocus
                autocomplete="username"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-all duration-200"
                placeholder="Nombre de usuario"
                value="{{ old('usuario') }}"
            >
            @error('usuario')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contraseña</label>
            <input
                type="password"
                name="password"
                id="password"
                required
                autocomplete="current-password"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-all duration-200"
                placeholder="Tu contraseña"
            >
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-4">
            <button
                type="submit"
                class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 transform hover:scale-[1.02] focus:ring-4 focus:ring-indigo-200 dark:focus:ring-indigo-800 shadow-lg"
            >
                Iniciar Sesión
            </button>
        </div>
    </form>

    @if (Route::has('register'))
        <div class="text-center pt-6 border-t border-gray-200 dark:border-gray-700">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ __('¿No tienes una cuenta?') }}
                <flux:link 
                    :href="route('register')" 
                    wire:navigate
                    class="font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors duration-200 ml-1"
                >
                    {{ __('Regístrate aquí') }}
                </flux:link>
            </p>
        </div>
    @endif

    <!-- Información adicional -->
    <div class="mt-8 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
        <div class="flex items-start space-x-3">
            <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <h4 class="text-sm font-medium text-blue-800 dark:text-blue-200">Acceso Seguro</h4>
                <p class="text-sm text-blue-600 dark:text-blue-300 mt-1">
                    Tu información está protegida con encriptación de nivel empresarial.
                </p>
            </div>
        </div>
    </div>

</div>

@script
<script>
    $wire.on('redirect', (event) => {
        console.log('Redirect event received:', event);
        setTimeout(() => {
            window.location.href = event.url || event[0].url;
        }, 100);
    });

    $wire.on('login-success', (event) => {
        console.log('Login success event received:', event);
        // Usar window.location.href para redirección completa
        window.location.href = event.url || event[0].url;
    });
</script>
@endscript
