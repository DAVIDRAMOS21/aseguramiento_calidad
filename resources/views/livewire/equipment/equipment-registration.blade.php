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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h1 class="text-5xl font-bold text-black mb-4 drop-shadow-lg">
                {{ $isEditing ? 'Editar Equipo' : 'Registro de Equipos' }}
            </h1>
            <p class="text-gray-100/80 text-lg max-w-2xl mx-auto leading-relaxed">
                {{ $isEditing ? 'Actualiza la información del equipo seleccionado.' : 'Registra nuevos equipos en el inventario del sistema. El identificador se genera automáticamente de forma secuencial.' }}
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
                                Registrar otro equipo
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
            
            <form wire:submit.prevent="createEquipment" class="relative z-10 p-8">
                
                <!-- Basic Information Section -->
                <div class="mb-10">
                    <div class="flex items-center mb-8">
                        <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                            <span class="text-gray-100 font-bold text-sm">1</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-gray-100 mb-2">Información Básica</h3>
                            <div class="h-1 w-20 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-full"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Nombre -->
                        <div class="relative group">
                            <label for="nombre" class="block text-sm font-semibold text-gray-100 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    Nombre del Equipo *
                                </span>
                            </label>
                            <div class="relative">
                                <input wire:model.live="nombre" 
                                       type="text" 
                                       id="nombre" 
                                       placeholder="Ej: Laptop Dell Inspiron" 
                                       class="block w-full px-5 py-4 bg-gray-700/80 backdrop-blur-md border border-gray-500/40 rounded-2xl shadow-lg text-gray-100 placeholder-gray-300 focus:ring-2 focus:ring-cyan-400/50 focus:border-cyan-400/50 focus:bg-gray-600/70 transition-all duration-300 @error('nombre') border-red-400/50 ring-2 ring-red-400/30 @enderror group-hover:bg-gray-600/70">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                    @if(!empty($nombre) && !$errors->has('nombre'))
                                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            @error('nombre') 
                                <p class="mt-3 text-sm text-red-300 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p> 
                            @enderror
                        </div>

                        <!-- Tipo de Elemento -->
                        <div class="relative group">
                            <label for="tipo_elemento" class="block text-sm font-semibold text-gray-100 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    Tipo de Elemento *
                                </span>
                            </label>
                            <div class="relative">
                                <select wire:model="tipo_elemento"
                                        id="tipo_elemento"
                                        class="block w-full px-5 py-4 bg-gray-700/80 backdrop-blur-md border border-gray-500/40 rounded-2xl shadow-lg text-gray-100 focus:ring-2 focus:ring-cyan-400/50 focus:border-cyan-400/50 focus:bg-gray-600/70 transition-all duration-300 @error('tipo_elemento') border-red-400/50 ring-2 ring-red-400/30 @enderror group-hover:bg-gray-600/70 appearance-none">
                                    <option value="informatica">Equipos de Informática</option>
                                    <option value="mobiliario">Mobiliario</option>
                                    <option value="oficina">Equipos de Oficina</option>
                                    <option value="otros">Otros</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                            @error('tipo_elemento')
                                <p class="mt-3 text-sm text-red-300 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Marca -->
                        <div class="relative group md:col-span-2">
                            <label for="id_marca" class="block text-sm font-semibold text-gray-100 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c1.1045695 0 2 .8954305 2 2v1M7 7c0 1.1045695.8954305 2 2 2h3c1.1045695 0 2-.8954305 2-2M7 7v3c0 1.1045695.8954305 2 2 2h3c1.1045695 0 2-.8954305 2-2V7m-7 10h5c1.1045695 0 2-.8954305 2-2v-1M7 17c0-1.1045695.8954305-2 2-2h3c1.1045695 0 2 .8954305 2 2M7 17v-3c0-1.1045695.8954305-2 2-2h3c1.1045695 0 2 .8954305 2 2v3"></path>
                                    </svg>
                                    Marca *
                                </span>
                            </label>
                            <div class="relative">
                                <select wire:model.live="id_marca"
                                        id="id_marca"
                                        class="block w-full px-5 py-4 bg-gray-700/80 backdrop-blur-md border border-gray-500/40 rounded-2xl shadow-lg text-gray-100 focus:ring-2 focus:ring-cyan-400/50 focus:border-cyan-400/50 focus:bg-gray-600/70 transition-all duration-300 @error('id_marca') border-red-400/50 ring-2 ring-red-400/30 @enderror group-hover:bg-gray-600/70 appearance-none">
                                    <option value="">Seleccionar marca</option>
                                    @foreach($marcas as $marca)
                                        <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                            @error('id_marca')
                                <p class="mt-3 text-sm text-red-300 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror

                            <!-- Campo para nueva marca (se muestra cuando selecciona "Otros") -->
                            @if($mostrar_nueva_marca)
                                <div class="mt-4 p-4 bg-cyan-500/10 backdrop-blur-md border border-cyan-400/30 rounded-2xl">
                                    <label for="nueva_marca" class="block text-sm font-semibold text-cyan-300 mb-3">
                                        <span class="flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            Nombre de la Nueva Marca *
                                        </span>
                                    </label>
                                    <input wire:model.live="nueva_marca"
                                           type="text"
                                           id="nueva_marca"
                                           placeholder="Ej: Lenovo, Acer, etc."
                                           class="block w-full px-5 py-4 bg-gray-700/80 backdrop-blur-md border border-cyan-400/40 rounded-2xl shadow-lg text-gray-100 placeholder-gray-300 focus:ring-2 focus:ring-cyan-400/50 focus:border-cyan-400/50 focus:bg-gray-600/70 transition-all duration-300 @error('nueva_marca') border-red-400/50 ring-2 ring-red-400/30 @enderror">
                                    @error('nueva_marca')
                                        <p class="mt-3 text-sm text-red-300 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                    <p class="mt-2 text-xs text-cyan-300">La nueva marca se agregará automáticamente al sistema</p>
                                </div>
                            @endif
                        </div>

                        <!-- Color -->
                        <div class="relative group">
                            <label for="color" class="block text-sm font-semibold text-gray-100 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM7 3H5a2 2 0 00-2 2v12a4 4 0 004 4h2a2 2 0 002-2V5a2 2 0 00-2-2z"></path>
                                    </svg>
                                    Color *
                                </span>
                            </label>
                            <div class="relative">
                                <input wire:model.live="color" 
                                       type="text" 
                                       id="color" 
                                       placeholder="Ej: Negro, Plata, Azul" 
                                       class="block w-full px-5 py-4 bg-gray-700/80 backdrop-blur-md border border-gray-500/40 rounded-2xl shadow-lg text-gray-100 placeholder-gray-300 focus:ring-2 focus:ring-cyan-400/50 focus:border-cyan-400/50 focus:bg-gray-600/70 transition-all duration-300 @error('color') border-red-400/50 ring-2 ring-red-400/30 @enderror group-hover:bg-gray-600/70">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                    @if(!empty($color) && !$errors->has('color'))
                                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            @error('color') 
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

                <!-- Technical Information Section -->
                <div class="mb-10 border-t border-gray-500/40 pt-10">
                    <div class="flex items-center mb-8">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                            <span class="text-gray-100 font-bold text-sm">2</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-gray-100 mb-2">Información Técnica</h3>
                            <div class="h-1 w-20 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Valor -->
                        <div class="relative group">
                            <label for="valor" class="block text-sm font-semibold text-gray-100 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Valor (Q) *
                                </span>
                            </label>
                            <div class="relative">
                                <input wire:model.live="valor" 
                                       type="number" 
                                       id="valor" 
                                       step="0.01" 
                                       min="0"
                                       placeholder="0.00" 
                                       class="block w-full px-5 py-4 bg-gray-700/80 backdrop-blur-md border border-gray-500/40 rounded-2xl shadow-lg text-gray-100 placeholder-gray-300 focus:ring-2 focus:ring-cyan-400/50 focus:border-cyan-400/50 focus:bg-gray-600/70 transition-all duration-300 @error('valor') border-red-400/50 ring-2 ring-red-400/30 @enderror group-hover:bg-gray-600/70">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                    @if(!empty($valor) && !$errors->has('valor'))
                                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            @error('valor') 
                                <p class="mt-3 text-sm text-red-300 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p> 
                            @enderror
                        </div>

                        <!-- Serie -->
                        <div class="relative group">
                            <label for="serie" class="block text-sm font-semibold text-gray-100 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Número de Serie *
                                </span>
                            </label>
                            <div class="relative">
                                <input wire:model.live="serie" 
                                       type="text" 
                                       id="serie" 
                                       placeholder="Ej: SN123456789" 
                                       class="block w-full px-5 py-4 bg-gray-700/80 backdrop-blur-md border border-gray-500/40 rounded-2xl shadow-lg text-gray-100 placeholder-gray-300 focus:ring-2 focus:ring-cyan-400/50 focus:border-cyan-400/50 focus:bg-gray-600/70 transition-all duration-300 @error('serie') border-red-400/50 ring-2 ring-red-400/30 @enderror group-hover:bg-gray-600/70 font-mono">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                    @if(!empty($serie) && !$errors->has('serie'))
                                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            @error('serie') 
                                <p class="mt-3 text-sm text-red-300 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p> 
                            @enderror
                        </div>

                        <!-- Tipo de Alimentación -->
                        <div class="relative group">
                            <label for="tipo_alimentacion" class="block text-sm font-semibold text-gray-100 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    Tipo de Alimentación *
                                </span>
                            </label>
                            <div class="relative">
                                <select wire:model="tipo_alimentacion"
                                        id="tipo_alimentacion"
                                        class="block w-full px-5 py-4 bg-gray-700/80 backdrop-blur-md border border-gray-500/40 rounded-2xl shadow-lg text-gray-100 focus:ring-2 focus:ring-cyan-400/50 focus:border-cyan-400/50 focus:bg-gray-600/70 transition-all duration-300 @error('tipo_alimentacion') border-red-400/50 ring-2 ring-red-400/30 @enderror group-hover:bg-gray-600/70 appearance-none">
                                    <option value="110v">110V</option>
                                    <option value="220v">220V</option>
                                    <option value="diesel">Diesel</option>
                                    <option value="regular">Gasolina Regular</option>
                                    <option value="super">Gasolina Super</option>
                                    <option value="bateria">Batería</option>
                                    <option value="ninguna">Ninguna</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                            @error('tipo_alimentacion') 
                                <p class="mt-3 text-sm text-red-300 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p> 
                            @enderror
                        </div>

                        <!-- Estado -->
                        <div class="relative group">
                            <label for="estado" class="block text-sm font-semibold text-gray-100 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Estado *
                                </span>
                            </label>
                            <div class="relative">
                                <select wire:model="estado"
                                        id="estado"
                                        class="block w-full px-5 py-4 bg-gray-700/80 backdrop-blur-md border border-gray-500/40 rounded-2xl shadow-lg text-gray-100 focus:ring-2 focus:ring-cyan-400/50 focus:border-cyan-400/50 focus:bg-gray-600/70 transition-all duration-300 @error('estado') border-red-400/50 ring-2 ring-red-400/30 @enderror group-hover:bg-gray-600/70 appearance-none">
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                    <option value="mantenimiento">Mantenimiento</option>
                                    <option value="suspendido">Suspendido</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                            @error('estado') 
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

                <!-- Assignment and Additional Information -->
                <div class="mb-10 border-t border-gray-500/40 pt-10">
                    <div class="flex items-center mb-8">
                        <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                            <span class="text-gray-100 font-bold text-sm">3</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-gray-100 mb-2">Asignación e Información Adicional</h3>
                            <div class="h-1 w-20 bg-gradient-to-r from-orange-500 to-red-600 rounded-full"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-8">
                        <!-- Empleado Asignado -->
                        <div class="relative group">
                            <label for="id_empleado" class="block text-sm font-semibold text-gray-100 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Empleado Asignado
                                </span>
                            </label>
                            <div class="relative">
                                <select wire:model="id_empleado"
                                        id="id_empleado"
                                        class="block w-full px-5 py-4 bg-gray-700/80 backdrop-blur-md border border-gray-500/40 rounded-2xl shadow-lg text-gray-100 focus:ring-2 focus:ring-cyan-400/50 focus:border-cyan-400/50 focus:bg-gray-600/70 transition-all duration-300 @error('id_empleado') border-red-400/50 ring-2 ring-red-400/30 @enderror group-hover:bg-gray-600/70 appearance-none">
                                    <option value="">Sin asignar</option>
                                    @foreach($empleados as $empleado)
                                        <option value="{{ $empleado->id }}">{{ $empleado->nombre_completo }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="mt-2 text-xs text-gray-300">Opcional - Selecciona un empleado para asignar el equipo</p>
                            @error('id_empleado') 
                                <p class="mt-3 text-sm text-red-300 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p> 
                            @enderror
                        </div>

                        <!-- Extras -->
                        <div class="relative group">
                            <label for="extras" class="block text-sm font-semibold text-gray-100 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 mr-1 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Información Adicional
                                </span>
                            </label>
                            <div class="relative">
                                <textarea wire:model="extras" 
                                          id="extras" 
                                          rows="4"
                                          placeholder="Especificaciones técnicas, accesorios, observaciones, etc." 
                                          class="block w-full px-5 py-4 bg-gray-700/80 backdrop-blur-md border border-gray-500/40 rounded-2xl shadow-lg text-gray-100 placeholder-gray-300 focus:ring-2 focus:ring-cyan-400/50 focus:border-cyan-400/50 focus:bg-gray-600/70 transition-all duration-300 resize-none @error('extras') border-red-400/50 ring-2 ring-red-400/30 @enderror group-hover:bg-gray-600/70"></textarea>
                            </div>
                            <p class="mt-2 text-xs text-gray-300">Información opcional sobre el equipo</p>
                            @error('extras') 
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

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-6 pt-8 border-t border-gray-500/40">
                    <button type="button"
                            wire:click="resetForm"
                            class="flex items-center justify-center px-8 py-4 bg-gray-700/80 backdrop-blur-md border-2 border-gray-400/50 rounded-2xl text-base font-semibold text-gray-100 hover:bg-gray-600/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white/50 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        {{ $isEditing ? 'Cancelar' : 'Limpiar Formulario' }}
                    </button>

                    <button type="submit"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed"
                            class="flex items-center justify-center px-10 py-4 bg-gradient-to-r from-emerald-500 to-teal-600 backdrop-blur-md border border-emerald-400/30 rounded-2xl text-base font-semibold text-gray-100 shadow-2xl hover:from-emerald-600 hover:to-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-300 transform hover:scale-105">
                        <span wire:loading.remove wire:target="createEquipment" class="flex items-center">
                            <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($isEditing)
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                @endif
                            </svg>
                            {{ $isEditing ? 'Actualizar Equipo' : 'Registrar Equipo' }}
                        </span>
                        <span wire:loading wire:target="createEquipment" class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            {{ $isEditing ? 'Actualizando...' : 'Registrando Equipo...' }}
                        </span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Helper Text -->
        <div class="mt-8 text-center">
            <p class="text-gray-300">
                Los campos marcados con * son obligatorios. {{ $isEditing ? 'Editando equipo.' : 'El equipo será registrado en el inventario del sistema.' }}
            </p>
        </div>

        <!-- Tabla de Equipos Registrados -->
        <div class="mt-12">
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow">
                <div class="p-4 border-b dark:border-zinc-700 flex-shrink-0">
                    <h3 class="text-lg font-semibold">Equipos Registrados</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                        Total de equipos: {{ $equipos->total() }}
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead class="bg-gray-50 dark:bg-zinc-900">
                            <tr>
                                <th class="text-left py-2 px-3 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Identificador
                                </th>
                                <th class="text-left py-2 px-3 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Nombre / Marca
                                </th>
                                <th class="text-left py-2 px-3 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Serie / Color
                                </th>
                                <th class="text-left py-2 px-3 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Información Adicional
                                </th>
                                <th class="text-left py-2 px-3 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Asignado a
                                </th>
                                <th class="text-center py-2 px-3 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Estado
                                </th>
                                <th class="text-center py-2 px-3 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-zinc-700 bg-white dark:bg-zinc-800">
                            @forelse($equipos as $equipo)
                                <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition-colors" wire:key="equipo-{{ $equipo->id }}">
                                    <td class="py-2.5 px-3">
                                        <div class="flex flex-col">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $equipo->identificador }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ ucfirst($equipo->tipo_elemento) }}</p>
                                        </div>
                                    </td>
                                    <td class="py-2.5 px-3">
                                        <div class="flex flex-col">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $equipo->nombre }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $equipo->marca->nombre ?? 'N/A' }}</p>
                                        </div>
                                    </td>
                                    <td class="py-2.5 px-3">
                                        <div class="flex flex-col">
                                            <p class="text-sm text-gray-900 dark:text-white truncate">{{ $equipo->serie }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Color: {{ $equipo->color }}</p>
                                        </div>
                                    </td>
                                    <td class="py-2.5 px-3">
                                        @if($equipo->extras)
                                            <p class="text-xs text-gray-700 dark:text-gray-300 line-clamp-2" title="{{ $equipo->extras }}">{{ $equipo->extras }}</p>
                                        @else
                                            <span class="text-xs text-gray-400 dark:text-gray-500 italic">Sin información adicional</span>
                                        @endif
                                    </td>
                                    <td class="py-2.5 px-3">
                                        @if($canEdit)
                                            <select wire:change="asignarEmpleado({{ $equipo->id }}, $event.target.value)"
                                                class="w-full text-xs px-2 py-1 border rounded dark:bg-zinc-700 dark:border-zinc-600 focus:ring-2 focus:ring-blue-500">
                                                <option value="">Sin asignar</option>
                                                @foreach($empleados as $empleado)
                                                    <option value="{{ $empleado->id }}" {{ $equipo->id_empleado == $empleado->id ? 'selected' : '' }}>
                                                        {{ $empleado->nombre_completo }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            @if($equipo->empleado)
                                                <p class="text-sm text-gray-900 dark:text-white truncate">{{ $equipo->empleado->nombre_completo }}</p>
                                            @else
                                                <span class="text-xs text-gray-400 dark:text-gray-500 italic">Sin asignar</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="py-2.5 px-3 text-center">
                                        @if($canEdit)
                                            <select wire:change="cambiarEstado({{ $equipo->id }}, $event.target.value)"
                                                class="appearance-none inline-flex items-center px-2 py-1 rounded-full text-xs font-medium cursor-pointer border-0 focus:ring-2 focus:ring-offset-1
                                                @if($equipo->estado === 'activo') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 focus:ring-green-500
                                                @elseif($equipo->estado === 'mantenimiento') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 focus:ring-yellow-500
                                                @elseif($equipo->estado === 'suspendido') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 focus:ring-red-500
                                                @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200 focus:ring-gray-500
                                                @endif">
                                                <option value="activo" {{ $equipo->estado === 'activo' ? 'selected' : '' }}>✓ Activo</option>
                                                <option value="inactivo" {{ $equipo->estado === 'inactivo' ? 'selected' : '' }}>✗ Inactivo</option>
                                                <option value="mantenimiento" {{ $equipo->estado === 'mantenimiento' ? 'selected' : '' }}>🔧 Mantenimiento</option>
                                                <option value="suspendido" {{ $equipo->estado === 'suspendido' ? 'selected' : '' }}>⛔ Suspendido</option>
                                            </select>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                @if($equipo->estado === 'activo') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                @elseif($equipo->estado === 'mantenimiento') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                                @elseif($equipo->estado === 'suspendido') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                                @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200
                                                @endif">
                                                {{ ucfirst($equipo->estado) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-2.5 px-3">
                                        <div class="flex gap-1.5 justify-center">
                                            @if($canEdit)
                                                <button wire:click="edit({{ $equipo->id }})"
                                                    class="inline-flex items-center px-2.5 py-1 text-xs font-medium bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200 rounded hover:bg-blue-200 dark:hover:bg-blue-800 transition-colors"
                                                    title="Editar equipo">
                                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                    Editar
                                                </button>
                                            @endif
                                            @if($canDelete)
                                                <button wire:click="delete({{ $equipo->id }})"
                                                    wire:confirm="¿Está seguro de eliminar este equipo?"
                                                    class="inline-flex items-center px-2.5 py-1 text-xs font-medium bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-200 rounded hover:bg-red-200 dark:hover:bg-red-800 transition-colors"
                                                    title="Eliminar equipo">
                                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Eliminar
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-8 text-center">
                                        <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                                        </svg>
                                        <p class="mt-3 text-sm text-gray-500 dark:text-gray-400">No hay equipos registrados</p>
                                        <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Usa el formulario arriba para registrar nuevo equipo</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($equipos->hasPages())
                    <div class="px-3 py-3 border-t dark:border-zinc-700 bg-gray-50 dark:bg-zinc-900">
                        {{ $equipos->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>