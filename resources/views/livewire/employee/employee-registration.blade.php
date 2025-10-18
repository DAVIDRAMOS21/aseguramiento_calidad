<div>
    <flux:heading size="xl">Registro de Personal</flux:heading>
    <flux:subheading>Administra el personal que puede tener equipos asignados</flux:subheading>

    @if($successMessage)
        <div class="mb-6 p-4 bg-green-100 text-green-700 rounded">
            {{ $successMessage }}
        </div>
    @endif

    @if($errorMessage)
        <div class="mb-6 p-4 bg-red-100 text-red-700 rounded">
            {{ $errorMessage }}
        </div>
    @endif

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 mt-6">
        <!-- Formulario -->
        <div class="xl:col-span-4">
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4">
                    {{ $isEditing ? 'Editar Empleado' : 'Nuevo Empleado' }}
                </h3>

                <form wire:submit.prevent="createEmployee" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Primer Nombre *</label>
                        <input type="text" wire:model="primer_nombre" placeholder="Primer nombre"
                            class="w-full px-3 py-2 border rounded-lg dark:bg-zinc-700 dark:border-zinc-600" />
                        @error('primer_nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Segundo Nombre *</label>
                        <input type="text" wire:model="segundo_nombre" placeholder="Segundo nombre"
                            class="w-full px-3 py-2 border rounded-lg dark:bg-zinc-700 dark:border-zinc-600" />
                        @error('segundo_nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Primer Apellido *</label>
                        <input type="text" wire:model="primer_apellido" placeholder="Primer apellido"
                            class="w-full px-3 py-2 border rounded-lg dark:bg-zinc-700 dark:border-zinc-600" />
                        @error('primer_apellido') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Segundo Apellido *</label>
                        <input type="text" wire:model="segundo_apellido" placeholder="Segundo apellido"
                            class="w-full px-3 py-2 border rounded-lg dark:bg-zinc-700 dark:border-zinc-600" />
                        @error('segundo_apellido') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Usuario del Sistema (Opcional)</label>
                        <select wire:model="id_usuario" class="w-full px-3 py-2 border rounded-lg dark:bg-zinc-700 dark:border-zinc-600">
                            <option value="">Sin usuario</option>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->usuario }} ({{ $usuario->name }})</option>
                            @endforeach
                        </select>
                        @error('id_usuario') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Estado *</label>
                        <select wire:model="estado" class="w-full px-3 py-2 border rounded-lg dark:bg-zinc-700 dark:border-zinc-600">
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                            <option value="vacaciones">Vacaciones</option>
                        </select>
                        @error('estado') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex gap-2 pt-4">
                        @if($isEditing)
                            <button type="button" wire:click="resetForm"
                                class="px-4 py-2 bg-gray-200 dark:bg-zinc-700 rounded-lg hover:bg-gray-300">
                                Cancelar
                            </button>
                        @endif
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            {{ $isEditing ? 'Actualizar' : 'Registrar' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Lista de Empleados -->
        <div class="xl:col-span-8">
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow h-full flex flex-col">
                <div class="p-4 border-b dark:border-zinc-700 flex-shrink-0">
                    <h3 class="text-lg font-semibold">Personal Registrado</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                        Total de empleados: {{ $empleados->total() }}
                    </p>
                </div>

                <div class="overflow-x-auto flex-1">
                    <table class="w-full table-auto">
                        <thead class="bg-gray-50 dark:bg-zinc-900 sticky top-0">
                            <tr>
                                <th class="text-left py-2 px-3 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider w-2/5">
                                    Nombre Completo
                                </th>
                                <th class="text-left py-2 px-3 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider w-1/5">
                                    Usuario Sistema
                                </th>
                                <th class="text-center py-2 px-3 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider w-1/6">
                                    Estado
                                </th>
                                <th class="text-center py-2 px-3 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider w-1/5">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-zinc-700 bg-white dark:bg-zinc-800">
                            @forelse($empleados as $empleado)
                                <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition-colors" wire:key="empleado-{{ $empleado->id }}">
                                    <td class="py-2.5 px-3">
                                        <div class="flex items-center gap-2">
                                            <div class="flex-shrink-0 h-8 w-8 bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-900 dark:to-blue-800 rounded-full flex items-center justify-center">
                                                <span class="text-blue-700 dark:text-blue-200 font-semibold text-xs">
                                                    {{ substr($empleado->primer_nombre, 0, 1) }}{{ substr($empleado->primer_apellido, 0, 1) }}
                                                </span>
                                            </div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                                {{ $empleado->nombre_completo }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="py-2.5 px-3">
                                        @if($empleado->usuario)
                                            <div class="flex flex-col">
                                                <p class="text-sm text-gray-900 dark:text-white truncate">{{ $empleado->usuario->usuario }}</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $empleado->usuario->name }}</p>
                                            </div>
                                        @else
                                            <span class="text-xs text-gray-400 dark:text-gray-500 italic">Sin asignar</span>
                                        @endif
                                    </td>
                                    <td class="py-2.5 px-3 text-center">
                                        @if($canEdit)
                                            <div class="relative inline-block text-left">
                                                <select wire:change="cambiarEstado({{ $empleado->id }}, $event.target.value)"
                                                    class="appearance-none inline-flex items-center px-2 py-1 rounded-full text-xs font-medium cursor-pointer border-0 focus:ring-2 focus:ring-offset-1
                                                    @if($empleado->estado === 'activo') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 focus:ring-green-500
                                                    @elseif($empleado->estado === 'vacaciones') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 focus:ring-yellow-500
                                                    @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200 focus:ring-gray-500
                                                    @endif">
                                                    <option value="activo" {{ $empleado->estado === 'activo' ? 'selected' : '' }}>✓ Activo</option>
                                                    <option value="inactivo" {{ $empleado->estado === 'inactivo' ? 'selected' : '' }}>✗ Inactivo</option>
                                                    <option value="vacaciones" {{ $empleado->estado === 'vacaciones' ? 'selected' : '' }}>🔔 Vacaciones</option>
                                                </select>
                                            </div>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                @if($empleado->estado === 'activo') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                @elseif($empleado->estado === 'vacaciones') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                                @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200
                                                @endif">
                                                @if($empleado->estado === 'activo')
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                @elseif($empleado->estado === 'vacaciones')
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6z"></path>
                                                    </svg>
                                                @else
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                                    </svg>
                                                @endif
                                                {{ ucfirst($empleado->estado) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-2.5 px-3">
                                        <div class="flex gap-1.5 justify-center">
                                            @if($canEdit)
                                                <button wire:click="edit({{ $empleado->id }})"
                                                    class="inline-flex items-center px-2.5 py-1 text-xs font-medium bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200 rounded hover:bg-blue-200 dark:hover:bg-blue-800 transition-colors"
                                                    title="Editar empleado">
                                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                    Editar
                                                </button>
                                            @endif
                                            @if($canDelete)
                                                <button wire:click="delete({{ $empleado->id }})"
                                                    wire:confirm="¿Está seguro de eliminar a {{ $empleado->nombre_completo }}?"
                                                    class="inline-flex items-center px-2.5 py-1 text-xs font-medium bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-200 rounded hover:bg-red-200 dark:hover:bg-red-800 transition-colors"
                                                    title="Eliminar empleado">
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
                                    <td colspan="4" class="py-8 text-center">
                                        <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <p class="mt-3 text-sm text-gray-500 dark:text-gray-400">No hay empleados registrados</p>
                                        <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Usa el formulario para agregar nuevo personal</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($empleados->hasPages())
                    <div class="px-3 py-3 border-t dark:border-zinc-700 bg-gray-50 dark:bg-zinc-900 flex-shrink-0">
                        {{ $empleados->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
