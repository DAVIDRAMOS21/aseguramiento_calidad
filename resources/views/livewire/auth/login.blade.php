<div class="space-y-6">
    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />
    
    <!-- Success Message -->
    @if($successMessage)
        <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <p class="text-sm font-medium text-green-800 dark:text-green-200">{{ $successMessage }}</p>
            </div>
        </div>
    @endif

    <!-- Error Message -->
    @if($errorMessage)
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <p class="text-sm font-medium text-red-800 dark:text-red-200">{{ $errorMessage }}</p>
            </div>
        </div>
    @endif

    <form method="POST" wire:submit="login" class="space-y-6">
        <!-- Usuario -->
        <div class="space-y-2">
            <flux:input
                wire:model="usuario"
                :label="__('Usuario')"
                type="text"
                required
                autofocus
                autocomplete="username"
                placeholder="Nombre de usuario"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-all duration-200"
            />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <div class="relative">
                <flux:input
                    wire:model="password"
                    :label="__('Contraseña')"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Tu contraseña')"
                    viewable
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-all duration-200"
                />
                
                @if (Route::has('password.request'))
                    <div class="text-right mt-2">
                        <flux:link 
                            class="text-sm text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors duration-200" 
                            :href="route('password.request')" 
                            wire:navigate
                        >
                            {{ __('¿Olvidaste tu contraseña?') }}
                        </flux:link>
                    </div>
                @endif
            </div>
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <flux:checkbox 
                wire:model="remember" 
                :label="__('Recordarme')"
                class="text-indigo-600 focus:ring-indigo-500"
            />
        </div>

        <!-- Login Button -->
        <div class="space-y-4">
            <flux:button 
                variant="primary" 
                type="submit" 
                class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 transform hover:scale-[1.02] focus:ring-4 focus:ring-indigo-200 dark:focus:ring-indigo-800 shadow-lg"
                wire:loading.attr="disabled"
                wire:loading.class="opacity-75 cursor-not-allowed"
            >
                <span wire:loading.remove>{{ __('Iniciar Sesión') }}</span>
                <span wire:loading class="flex items-center justify-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    {{ __('Iniciando sesión...') }}
                </span>
            </flux:button>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Livewire.on('login-success', () => {
                setTimeout(() => {
                    window.location.href = '/dashboard';
                }, 1000); // Esperar 1 segundo para mostrar el mensaje de éxito
            });
        });
    </script>
</div>
