<div class="min-h-screen relative overflow-hidden bg-gradient-to-br from-violet-900 via-purple-800 to-indigo-900">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 rounded-full bg-gradient-to-br from-pink-400/20 to-purple-600/20 blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 rounded-full bg-gradient-to-br from-blue-400/20 to-indigo-600/20 blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/3 left-1/2 w-60 h-60 rounded-full bg-gradient-to-br from-cyan-400/10 to-teal-500/10 blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
        
        <!-- Geometric patterns -->
        <div class="absolute inset-0 opacity-10" style="background-image: linear-gradient(rgba(255,255,255,.1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.1) 1px, transparent 1px); background-size: 50px 50px;"></div>
        
        <!-- Floating particles -->
        <div class="absolute top-20 left-20 w-2 h-2 bg-white/30 rounded-full animate-bounce" style="animation-delay: 0.5s;"></div>
        <div class="absolute top-40 right-32 w-3 h-3 bg-purple-300/40 rounded-full animate-bounce" style="animation-delay: 1.5s;"></div>
        <div class="absolute bottom-32 left-1/4 w-2 h-2 bg-cyan-300/40 rounded-full animate-bounce" style="animation-delay: 2.5s;"></div>
        <div class="absolute bottom-20 right-20 w-4 h-4 bg-pink-300/30 rounded-full animate-bounce" style="animation-delay: 3s;"></div>
    </div>

    <div class="relative z-10 max-w-4xl mx-auto p-6">
        <!-- Header Section with Glass Morphism -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-12 h-12 bg-gray-700/80 backdrop-blur-md rounded-2xl mb-6 border border-gray-500/40 shadow-xl">
                <svg class="w-5 h-5 text-gray-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
            </div>
            <h1 class="text-5xl font-bold text-black mb-4 drop-shadow-lg">
                Registro de Usuarios
            </h1>
            <p class="text-gray-100/80 text-lg max-w-2xl mx-auto leading-relaxed">
                Crea nuevos usuarios con diferentes roles y permisos. Los datos se validarán automáticamente y el nombre de usuario se generará basado en el nombre completo.
            </p>
            
            <!-- Decorative line -->
            <div class="mt-6 flex justify-center">
                <div class="w-24 h-1 bg-gradient-to-r from-transparent via-white/60 to-transparent rounded-full"></div>
            </div>
        </div>

        <!-- Success/Error Messages with Glass Effect -->
        @if (!empty($successMessage))
            <div class="mb-8 relative">
                <div class="bg-emerald-500/20 backdrop-blur-md rounded-2xl p-1 shadow-2xl border border-emerald-400/30">
                    <div class="bg-white/10 rounded-xl p-6 border border-gray-500/40">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-emerald-400/20 backdrop-blur-sm rounded-full flex items-center justify-center border border-emerald-300/30">
                                    <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="text-gray-100 font-medium">{{ $successMessage }}</p>
                            </div>
                            <button wire:click="resetForm" class="ml-4 bg-emerald-500/20 hover:bg-emerald-500/30 backdrop-blur-sm text-gray-100 px-6 py-3 rounded-xl transition-all duration-300 font-medium border border-emerald-400/30 hover:scale-105">
                                Crear otro usuario
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (!empty($errorMessage))
            <div class="mb-8 relative">
                <div class="bg-red-500/20 backdrop-blur-md rounded-2xl p-1 shadow-2xl border border-red-400/30">
                    <div class="bg-white/10 rounded-xl p-6 border border-gray-500/40">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-red-400/20 backdrop-blur-sm rounded-full flex items-center justify-center border border-red-300/30">
                                    <svg class="w-4 h-4 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-100 font-medium">{{ $errorMessage }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form Card with Ultra-Modern Glass Morphism -->
        <div class="bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl border border-gray-500/40 overflow-hidden relative">
            <!-- Form gradient overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-white/5 to-transparent"></div>
            
            <form wire:submit.prevent="createUser" class="relative z-10 p-8">
                
                <!-- Personal Information Section -->
                <div class="mb-10">
                    <div class="flex items-center mb-8">
                        <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                            <span class="text-gray-100 font-bold text-sm">1</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-gray-100 mb-2">Información Personal</h3>
                            <div class="h-1 w-20 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-full"></div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Nombres -->
                        <div class="relative group">
                            <label for="nombres" class="block text-sm font-semibold text-gray-100 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Nombres *
                                </span>
                            </label>
                            <div class="relative">
                                <input wire:model.live="nombres" 
                                       type="text" 
                                       id="nombres" 
                                       placeholder="Ej: Juan Carlos" 
                                       class="block w-full px-5 py-4 bg-gray-700/80 backdrop-blur-md border border-gray-500/40 rounded-2xl shadow-lg text-gray-100 placeholder-gray-300 focus:ring-2 focus:ring-cyan-400/50 focus:border-cyan-400/50 focus:bg-gray-600/70 transition-all duration-300 @error('nombres') border-red-400/50 ring-2 ring-red-400/30 @enderror group-hover:bg-gray-600/70">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                    @if(!empty($nombres) && !$errors->has('nombres'))
                                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            @error('nombres') 
                                <p class="mt-3 text-sm text-red-300 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p> 
                            @enderror
                        </div>

                        <!-- Apellidos -->
                        <div class="relative group">
                            <label for="apellidos" class="block text-sm font-semibold text-gray-100 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    Apellidos *
                                </span>
                            </label>
                            <div class="relative">
                                <input wire:model.live="apellidos" 
                                       type="text" 
                                       id="apellidos" 
                                       placeholder="Ej: Pérez González" 
                                       class="block w-full px-5 py-4 bg-gray-700/80 backdrop-blur-md border border-gray-500/40 rounded-2xl shadow-lg text-gray-100 placeholder-gray-300 focus:ring-2 focus:ring-cyan-400/50 focus:border-cyan-400/50 focus:bg-gray-600/70 transition-all duration-300 @error('apellidos') border-red-400/50 ring-2 ring-red-400/30 @enderror group-hover:bg-gray-600/70">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                    @if(!empty($apellidos) && !$errors->has('apellidos'))
                                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            @error('apellidos') 
                                <p class="mt-3 text-sm text-red-300 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p> 
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="relative group">
                            <label for="email" class="block text-sm font-semibold text-gray-100 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                    Correo Electrónico *
                                </span>
                            </label>
                            <div class="relative">
                                <input wire:model="email" 
                                       type="email" 
                                       id="email" 
                                       placeholder="ejemplo@correo.com" 
                                       class="block w-full px-5 py-4 bg-gray-700/80 backdrop-blur-md border border-gray-500/40 rounded-2xl shadow-lg text-gray-100 placeholder-gray-300 focus:ring-2 focus:ring-cyan-400/50 focus:border-cyan-400/50 focus:bg-gray-600/70 transition-all duration-300 @error('email') border-red-400/50 ring-2 ring-red-400/30 @enderror group-hover:bg-gray-600/70">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                    @if(!empty($email) && !$errors->has('email'))
                                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            @error('email') 
                                <p class="mt-3 text-sm text-red-300 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p> 
                            @enderror
                        </div>

                        <!-- DPI -->
                        <div class="relative group">
                            <label for="dpi" class="block text-sm font-semibold text-gray-100 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V4a2 2 0 114 0v2m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                                    </svg>
                                    DPI *
                                </span>
                            </label>
                            <div class="relative">
                                <input wire:model.live="dpi" 
                                       type="text" 
                                       id="dpi" 
                                       placeholder="1234 56789 1019" 
                                       maxlength="15"
                                       class="block w-full px-5 py-4 bg-gray-700/80 backdrop-blur-md border border-gray-500/40 rounded-2xl shadow-lg text-gray-100 placeholder-gray-300 focus:ring-2 focus:ring-cyan-400/50 focus:border-cyan-400/50 focus:bg-gray-600/70 transition-all duration-300 font-mono @error('dpi') border-red-400/50 ring-2 ring-red-400/30 @enderror group-hover:bg-gray-600/70">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                    @if(!empty($dpi) && !$errors->has('dpi'))
                                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            <p class="mt-2 text-xs text-gray-300">Formato: 1234 56789 1019 (se formatea automáticamente)</p>
                            @error('dpi') 
                                <p class="mt-3 text-sm text-red-300 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p> 
                            @enderror
                        </div>

                        <!-- Teléfono -->
                        <div class="relative group md:col-span-2">
                            <label for="telefono" class="block text-sm font-semibold text-gray-100 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    Teléfono (Guatemala)
                                </span>
                            </label>
                            <div class="relative">
                                <input wire:model.live="telefono" 
                                       type="tel" 
                                       id="telefono" 
                                       placeholder="1234 5678" 
                                       maxlength="9"
                                       class="block w-full px-5 py-4 bg-gray-700/80 backdrop-blur-md border border-gray-500/40 rounded-2xl shadow-lg text-gray-100 placeholder-gray-300 focus:ring-2 focus:ring-cyan-400/50 focus:border-cyan-400/50 focus:bg-gray-600/70 transition-all duration-300 font-mono @error('telefono') border-red-400/50 ring-2 ring-red-400/30 @enderror group-hover:bg-gray-600/70">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                    @if(!empty($telefono) && !$errors->has('telefono'))
                                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            <p class="mt-2 text-xs text-gray-300">Formato: 1234 5678 (se formatea automáticamente)</p>
                            @error('telefono') 
                                <p class="mt-3 text-sm text-red-300 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p> 
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Account Information Section -->
                <div class="mb-10 border-t border-gray-500/40 pt-10">
                    <div class="flex items-center mb-8">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                            <span class="text-gray-100 font-bold text-sm">2</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-gray-100 mb-2">Información de Cuenta</h3>
                            <div class="h-1 w-20 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Usuario generado -->
                        <div class="relative group md:col-span-2">
                            <label for="usuario" class="block text-sm font-semibold text-gray-100 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Usuario del Sistema
                                    <span class="ml-3 px-3 py-1 bg-emerald-500/20 backdrop-blur-sm text-emerald-300 text-xs rounded-full border border-emerald-400/30">Generado automáticamente</span>
                                </span>
                            </label>
                            <div class="relative">
                                <input wire:model="usuario" 
                                       type="text" 
                                       id="usuario" 
                                       readonly 
                                       class="block w-full px-5 py-4 bg-gray-800/80 backdrop-blur-md border border-gray-500/40 rounded-2xl shadow-lg text-gray-200 font-mono cursor-not-allowed">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                    <svg class="w-4 h-4 text-gray-100/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="mt-2 text-xs text-gray-300">Se genera automáticamente usando: nombre.apellido</p>
                        </div>

                        <!-- Contraseña -->
                        <div class="relative group">
                            <label for="password" class="block text-sm font-semibold text-gray-100 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    Contraseña *
                                </span>
                            </label>
                            <div class="relative">
                                <input wire:model="password" 
                                       type="password" 
                                       id="password" 
                                       class="block w-full px-5 py-4 bg-gray-700/80 backdrop-blur-md border border-gray-500/40 rounded-2xl shadow-lg text-gray-100 placeholder-gray-300 focus:ring-2 focus:ring-purple-400/50 focus:border-purple-400/50 focus:bg-gray-600/70 transition-all duration-300 @error('password') border-red-400/50 ring-2 ring-red-400/30 @enderror group-hover:bg-gray-600/70">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                    @if(strlen($password) >= 6 && !$errors->has('password'))
                                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            @error('password') 
                                <p class="mt-3 text-sm text-red-300 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p> 
                            @enderror
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="relative group">
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-100 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Confirmar Contraseña *
                                </span>
                            </label>
                            <div class="relative">
                                <input wire:model="password_confirmation" 
                                       type="password" 
                                       id="password_confirmation" 
                                       class="block w-full px-5 py-4 bg-gray-700/80 backdrop-blur-md border border-gray-500/40 rounded-2xl shadow-lg text-gray-100 placeholder-gray-300 focus:ring-2 focus:ring-purple-400/50 focus:border-purple-400/50 focus:bg-gray-600/70 transition-all duration-300 group-hover:bg-gray-600/70">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                    @if(!empty($password_confirmation) && $password === $password_confirmation && strlen($password) >= 6)
                                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Roles and Permissions Section -->
                <div class="mb-10 border-t border-gray-500/40 pt-10">
                    <div class="flex items-center mb-8">
                        <div class="w-8 h-8 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                            <span class="text-gray-100 font-bold text-sm">3</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-gray-100 mb-2">Roles y Permisos</h3>
                            <div class="h-1 w-20 bg-gradient-to-r from-emerald-400 to-teal-500 rounded-full"></div>
                        </div>
                    </div>

                    <!-- Roles -->
                    <div class="mb-8">
                        <label class="text-lg font-bold text-gray-100 mb-6 block">Roles del Usuario</label>
                        <p class="text-gray-200 mb-6">Selecciona uno o más roles para asignar al usuario.</p>
                        
                        <div class="space-y-4">
                            @foreach($availableRoles as $role)
                                <div class="flex items-start p-8 bg-gray-700/80 backdrop-blur-sm rounded-2xl border border-orange-400/20 hover:bg-gray-600/70 transition-all duration-300">
                                    <input wire:model="roles" id="role_{{ $role }}" type="checkbox" value="{{ $role }}" class="h-5 w-5 text-orange-500 focus:ring-orange-400/50 border-gray-400/50 rounded-lg bg-gray-700/80 backdrop-blur-sm mt-1 mr-6 flex-shrink-0">
                                    <div class="flex-1">
                                        <label for="role_{{ $role }}" class="text-base font-semibold text-gray-100 cursor-pointer">{{ ucfirst($role) }}</label>
                                        <p class="text-sm text-gray-200 mt-2 leading-relaxed">El usuario tendrá acceso a las funciones correspondientes al rol {{ ucfirst($role) }}.</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Administrative Permissions -->
                    <div class="bg-gradient-to-br from-orange-500/10 to-red-500/10 backdrop-blur-sm rounded-2xl p-8 border border-orange-400/20">
                        <h4 class="text-xl font-bold text-gray-100 mb-6">Permisos Administrativos</h4>
                        
                        <div class="space-y-8">
                            <div class="flex items-start p-8 bg-gray-700/80 backdrop-blur-sm rounded-2xl border border-orange-400/20 hover:bg-gray-600/70 transition-all duration-300">
                                <input wire:model="is_admin" id="is_admin" type="checkbox" class="h-5 w-5 text-orange-500 focus:ring-orange-400/50 border-gray-400/50 rounded-lg bg-gray-700/80 backdrop-blur-sm mt-1 mr-6 flex-shrink-0">
                                <div class="flex-1">
                                    <label for="is_admin" class="text-base font-semibold text-gray-100 cursor-pointer">Administrador</label>
                                    <p class="text-sm text-gray-200 mt-2 leading-relaxed">El usuario tendrá acceso a funciones administrativas del sistema.</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start p-8 bg-gray-700/80 backdrop-blur-sm rounded-2xl border border-red-400/20 hover:bg-gray-600/70 transition-all duration-300">
                                <input wire:model="is_superuser" id="is_superuser" type="checkbox" class="h-5 w-5 text-red-500 focus:ring-red-400/50 border-gray-400/50 rounded-lg bg-gray-700/80 backdrop-blur-sm mt-1 mr-6 flex-shrink-0">
                                <div class="flex-1">
                                    <label for="is_superuser" class="text-base font-semibold text-gray-100 cursor-pointer">Super Usuario</label>
                                    <p class="text-sm text-gray-200 mt-2 leading-relaxed">El usuario tendrá credenciales de super usuario para operaciones críticas.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Super User Credentials -->
                    @if($is_superuser)
                        <div class="mt-8 bg-gradient-to-br from-red-500/15 to-pink-500/15 backdrop-blur-sm rounded-2xl p-8 border border-red-400/30">
                            <h4 class="text-xl font-bold text-gray-100 mb-6 flex items-center">
                                <svg class="w-3 h-3 mr-2 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Credenciales de Super Usuario
                            </h4>
                            
                            <!-- Opción de usar la misma contraseña -->
                            <div class="mb-6">
                                <div class="flex items-start p-6 bg-gray-700/80 backdrop-blur-sm rounded-2xl border border-blue-400/20 hover:bg-gray-600/70 transition-all duration-300">
                                    <input wire:model="use_same_password" id="use_same_password" type="checkbox" class="h-5 w-5 text-blue-500 focus:ring-blue-400/50 border-gray-400/50 rounded-lg bg-gray-700/80 backdrop-blur-sm mt-1 mr-6 flex-shrink-0">
                                    <div class="flex-1">
                                        <label for="use_same_password" class="text-base font-semibold text-gray-100 cursor-pointer">Usar la misma contraseña del usuario</label>
                                        <p class="text-sm text-gray-200 mt-2 leading-relaxed">Utilizar la misma contraseña que se está configurando para el usuario regular.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="relative group">
                                    <label for="superuser_username" class="block text-sm font-semibold text-gray-100 mb-3">Usuario Super Usuario</label>
                                    <input wire:model="superuser_username" 
                                           type="text" 
                                           id="superuser_username" 
                                           class="block w-full px-5 py-4 bg-gray-700/80 backdrop-blur-md border border-red-400/30 rounded-2xl shadow-lg text-gray-100 placeholder-gray-300 focus:ring-2 focus:ring-red-400/50 focus:border-red-400/50 focus:bg-gray-600/70 transition-all duration-300 @error('superuser_username') border-red-400/70 ring-2 ring-red-400/50 @enderror group-hover:bg-gray-600/70">
                                    @error('superuser_username') <p class="mt-3 text-sm text-red-300">{{ $message }}</p> @enderror
                                </div>

                                @if(!$use_same_password)
                                    <div class="relative group">
                                        <label for="superuser_password" class="block text-sm font-semibold text-gray-100 mb-3">Contraseña Super Usuario</label>
                                        <input wire:model="superuser_password" 
                                               type="password" 
                                               id="superuser_password" 
                                               class="block w-full px-5 py-4 bg-gray-700/80 backdrop-blur-md border border-red-400/30 rounded-2xl shadow-lg text-gray-100 placeholder-gray-300 focus:ring-2 focus:ring-red-400/50 focus:border-red-400/50 focus:bg-gray-600/70 transition-all duration-300 @error('superuser_password') border-red-400/70 ring-2 ring-red-400/50 @enderror group-hover:bg-gray-600/70">
                                        @error('superuser_password') <p class="mt-3 text-sm text-red-300">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="relative group md:col-span-2">
                                        <label for="superuser_password_confirmation" class="block text-sm font-semibold text-gray-100 mb-3">Confirmar Contraseña Super Usuario</label>
                                        <input wire:model="superuser_password_confirmation" 
                                               type="password" 
                                               id="superuser_password_confirmation" 
                                               class="block w-full px-5 py-4 bg-gray-700/80 backdrop-blur-md border border-red-400/30 rounded-2xl shadow-lg text-gray-100 placeholder-gray-300 focus:ring-2 focus:ring-red-400/50 focus:border-red-400/50 focus:bg-gray-600/70 transition-all duration-300 group-hover:bg-gray-600/70">
                                    </div>
                                @else
                                    <div class="md:col-span-2">
                                        <div class="flex items-center p-6 bg-blue-500/10 backdrop-blur-sm rounded-2xl border border-blue-400/20">
                                            <svg class="w-5 h-5 text-blue-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <p class="text-sm text-gray-200">Se utilizará la misma contraseña configurada para el usuario regular.</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-6 pt-8 border-t border-gray-500/40">
                    <button type="button" 
                            wire:click="resetForm" 
                            class="flex items-center justify-center px-8 py-4 bg-gray-700/80 backdrop-blur-md border-2 border-gray-400/50 rounded-2xl text-base font-semibold text-gray-100 hover:bg-gray-600/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white/50 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Limpiar Formulario
                    </button>
                    
                    <button type="submit" 
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed"
                            class="flex items-center justify-center px-10 py-4 bg-gradient-to-r from-emerald-500 to-teal-600 backdrop-blur-md border border-emerald-400/30 rounded-2xl text-base font-semibold text-black shadow-2xl hover:from-emerald-600 hover:to-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-300 transform hover:scale-105">
                        <span wire:loading.remove wire:target="createUser" class="flex items-center">
                            <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            Crear Usuario
                        </span>
                        <span wire:loading wire:target="createUser" class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Creando Usuario...
                        </span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Helper Text -->
        <div class="mt-8 text-center">
            <p class="text-gray-300">
                Los campos marcados con * son obligatorios. El nombre de usuario se generará automáticamente.
            </p>
        </div>
    </div>
</div>

