<div class="p-6" 
     x-data="{ 
        notification: { show: false, type: '', message: '' },
        showNotification(type, message) {
            this.notification = { show: true, type, message };
            setTimeout(() => { this.notification.show = false; }, 5000);
        }
    }" 
     @notification.window="showNotification($event.detail.type, $event.detail.message)">
    
    <!-- Toast Notification -->
    <div x-show="notification.show" 
         x-transition:enter="transform ease-out duration-300 transition"
         x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
         x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed top-5 right-5 z-50 max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
        <div class="p-4">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div x-show="notification.type === 'success'" class="h-6 w-6 text-green-400">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div x-show="notification.type === 'error'" class="h-6 w-6 text-red-400">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                        </svg>
                    </div>
                </div>
                <div class="ml-3 w-0 flex-1 pt-0.5">
                    <p class="text-sm font-medium text-gray-900">
                        <span x-show="notification.type === 'success'">¡Éxito!</span>
                        <span x-show="notification.type === 'error'">Error</span>
                    </p>
                    <p class="mt-1 text-sm text-gray-500" x-text="notification.message"></p>
                </div>
                <div class="ml-4 flex-shrink-0 flex">
                    <button @click="notification.show = false" 
                            class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="sr-only">Cerrar</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Gestión de Roles de Usuario</h1>
            <p class="mt-2 text-sm text-gray-700">Asigna roles a los usuarios. Se requieren credenciales de super usuario para realizar cambios.</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <button wire:click="openCreateSuperuserModal" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                Crear Super Usuario
            </button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mt-4 rounded-md bg-green-50 p-4 border border-green-200 shadow-sm" x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3 flex-1">
                    <h3 class="text-sm font-medium text-green-800">¡Operación Exitosa!</h3>
                    <p class="text-sm text-green-700 mt-1">{{ session('message') }}</p>
                </div>
                <div class="ml-auto pl-3">
                    <button type="button" class="inline-flex text-green-400 hover:text-green-600 focus:outline-none focus:text-green-600" @click="show = false">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Roles Actuales</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th scope="col" class="relative px-6 py-3"><span class="sr-only">Acciones</span></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-indigo-600 flex items-center justify-center">
                                                    <span class="text-sm font-medium text-white">{{ $user->initials() }}</span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $user->usuario }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-wrap gap-1">
                                            @if($user->roles)
                                                @foreach($user->roles as $role)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                        {{ $role }}
                                                    </span>
                                                @endforeach
                                            @else
                                                <span class="text-sm text-gray-500">Sin roles asignados</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if($user->is_superuser)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Super Usuario
                                                </span>
                                            @endif
                                            @if($user->is_admin)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 ml-2">
                                                    Admin
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button wire:click="openRoleModal({{ $user->id }})" class="text-indigo-600 hover:text-indigo-900">
                                            Gestionar Roles
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para asignar roles -->
    @if($showRoleModal)
        <div class="fixed inset-0 z-[60] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
                <div wire:click="closeRoleModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity cursor-pointer" aria-hidden="true"></div>
                <div wire:click.stop class="relative bg-white rounded-lg shadow-2xl max-w-md w-full mx-auto p-4 transform transition-all border border-gray-200">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Asignar Roles
                        </h3>
                        <div class="mt-3">
                            <p class="text-sm text-gray-500">
                                Selecciona los roles que deseas asignar al usuario.
                            </p>
                        </div>
                        
                        <div class="mt-4">
                            <label class="text-sm font-medium text-gray-900">Roles del Usuario:</label>
                            <div class="space-y-2 mt-3">
                                @foreach($this->availableRoles as $role)
                                    <div class="flex items-center p-2 bg-gray-50 rounded border hover:bg-gray-100">
                                        <input wire:model="selectedRoles" id="role-{{ $role }}" type="checkbox" value="{{ $role }}" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded mr-2">
                                        <label for="role-{{ $role }}" class="text-sm font-medium text-gray-900 cursor-pointer">{{ ucfirst($role) }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-4 space-y-3">
                            <div>
                                <label for="superuser-username" class="block text-sm font-medium text-gray-700">Usuario Super Usuario</label>
                                <input wire:model="superuserUsername" type="text" id="superuser-username" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('superuserUsername') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="superuser-password" class="block text-sm font-medium text-gray-700">Contraseña Super Usuario</label>
                                <input wire:model="superuserPassword" type="password" id="superuser-password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('superuserPassword') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        
                        @error('superuser') <div class="mt-2 text-red-500 text-xs">{{ $message }}</div> @enderror
                    </div>
                    <div class="mt-4 flex space-x-3">
                        <button wire:click="closeRoleModal" type="button" class="flex-1 px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cancelar
                        </button>
                        <button wire:click="updateRoles" type="button" 
                                class="flex-1 px-3 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200"
                                wire:loading.attr="disabled">
                            <div class="flex items-center justify-center">
                                <svg wire:loading wire:target="updateRoles" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span wire:loading.remove wire:target="updateRoles">Asignar Roles</span>
                                <span wire:loading wire:target="updateRoles">Asignando roles...</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal para crear super usuario -->
    @if($showCreateSuperuserModal)
        <div class="fixed inset-0 z-[60] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
                <div wire:click="closeCreateSuperuserModal" class="fixed inset-0 bg-gradient-to-br from-gray-900/60 via-slate-900/50 to-gray-900/60 backdrop-blur-sm transition-all duration-300 cursor-pointer" aria-hidden="true"></div>
                <div wire:click.stop class="relative bg-white rounded-xl shadow-2xl max-w-lg w-full mx-auto p-6 transform transition-all duration-300 border border-gray-100 max-h-[90vh] overflow-y-auto backdrop-blur-lg bg-white/95 ring-1 ring-black/5">
                    <div>
                        <div class="flex items-center justify-center w-8 h-8 mx-auto bg-indigo-100 rounded-full">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <div class="mt-3 text-center">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Promover Usuario a Super Usuario
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Selecciona un usuario existente y conviértelo en super usuario.
                                </p>
                            </div>
                        </div>
                        
                        <div class="mt-6 space-y-6">
                            <!-- Sección de selección de usuario -->
                            <div class="bg-gray-50 p-4 rounded-lg border">
                                <h4 class="text-sm font-medium text-gray-900 mb-3">Seleccionar Usuario</h4>
                                <div class="grid grid-cols-1 gap-4">
                                    <div>
                                        <label for="user-select" class="block text-sm font-medium text-gray-700">Usuario a Promover</label>
                                        <select wire:model.live="selectedUserId" id="user-select" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="">Seleccionar usuario...</option>
                                            @foreach($this->normalUsers as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->usuario }}
                                                    @if($user->roles)
                                                        ({{ implode(', ', $user->roles) }})
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('selectedUserId') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    @if($selectedUserId)
                                        <div class="mt-2 p-3 bg-blue-50 rounded-md">
                                            <div class="flex">
                                                <div class="flex-shrink-0">
                                                    <svg class="h-4 w-4 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <div class="ml-3 flex-1 md:flex md:justify-between">
                                                    <p class="text-sm text-blue-700">
                                                        Usuario seleccionado: <strong>{{ $selectedUser?->usuario ?? '' }}</strong>
                                                        @if($selectedUser?->roles)
                                                            <br>Roles actuales: {{ implode(', ', $selectedUser->roles) }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Sección de credenciales del nuevo super usuario -->
                            @if($selectedUserId)
                                <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                                    <h4 class="text-sm font-medium text-gray-900 mb-3 flex items-center">
                                        <svg class="w-3 h-3 text-yellow-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7 7h-3v4l-4-4H8a6 6 0 017-7z"></path>
                                        </svg>
                                        Credenciales de Super Usuario
                                    </h4>
                                    <p class="text-sm text-yellow-700 mb-4">Estas credenciales serán usadas para futuras operaciones administrativas.</p>
                                    
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label for="new-superuser-username" class="block text-sm font-medium text-gray-700">Nombre de Usuario Super Usuario</label>
                                            <input wire:model.live="newSuperuserUsername" type="text" id="new-superuser-username" 
                                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('newSuperuserUsername') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" 
                                                   placeholder="super_admin">
                                            @error('newSuperuserUsername') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                                        </div>
                                        
                                        <div>
                                            <label for="new-superuser-password" class="block text-sm font-medium text-gray-700">Contraseña Super Usuario</label>
                                            <input wire:model.live="newSuperuserPassword" type="password" id="new-superuser-password" 
                                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('newSuperuserPassword') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" 
                                                   placeholder="Mín. 8 caracteres">
                                            @error('newSuperuserPassword') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                                        </div>
                                        
                                        <div class="sm:col-span-2">
                                            <label for="new-superuser-confirm-password" class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
                                            <input wire:model.live="newSuperuserConfirmPassword" type="password" id="new-superuser-confirm-password" 
                                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('newSuperuserConfirmPassword') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" 
                                                   placeholder="Repetir contraseña">
                                            @error('newSuperuserConfirmPassword') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Sección de autenticación del primer super usuario -->
                            @if($selectedUserId && $newSuperuserUsername && $newSuperuserPassword && $newSuperuserConfirmPassword)
                                <div class="bg-red-50 p-4 rounded-lg border border-red-200">
                                    <h4 class="text-sm font-medium text-gray-900 mb-3 flex items-center">
                                        <svg class="w-3 h-3 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                        Autenticación Requerida
                                    </h4>
                                    <p class="text-sm text-red-700 mb-4">Por seguridad, ingresa las credenciales del primer super usuario registrado en el sistema.</p>
                                    
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label for="first-superuser-username" class="block text-sm font-medium text-gray-700">Usuario del Primer Super Usuario</label>
                                            <input wire:model="firstSuperuserUsername" type="text" id="first-superuser-username" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Nombre de usuario">
                                            @error('firstSuperuserUsername') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                        </div>
                                        
                                        <div>
                                            <label for="first-superuser-password" class="block text-sm font-medium text-gray-700">Contraseña del Primer Super Usuario</label>
                                            <input wire:model="firstSuperuserPassword" type="password" id="first-superuser-password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Contraseña">
                                            @error('firstSuperuserPassword') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        @error('create_superuser') 
                            <div class="mt-4 p-3 bg-red-50 rounded-md">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-red-800">Error</h3>
                                        <div class="mt-2 text-sm text-red-700">
                                            <p>{{ $message }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @enderror
                    </div>
                    <div class="mt-4 flex space-x-3">
                        <button wire:click="closeCreateSuperuserModal" type="button" class="flex-1 px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cancelar
                        </button>
                        <button wire:click="createSuperuser" type="button" 
                                class="flex-1 px-3 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed"
                                wire:loading.attr="disabled">
                            <div class="flex items-center justify-center">
                                <svg wire:loading wire:target="createSuperuser" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span wire:loading.remove wire:target="createSuperuser">Promover a Super Usuario</span>
                                <span wire:loading wire:target="createSuperuser">Promocionando usuario...</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
