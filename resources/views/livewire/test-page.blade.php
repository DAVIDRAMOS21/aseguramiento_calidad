<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="bg-green-600 px-6 py-4">
                <h1 class="text-2xl font-bold text-white">✅ Página de Prueba - Login Exitoso</h1>
            </div>

            <div class="p-6">
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Estado de Autenticación</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm font-medium text-gray-600">Autenticado</p>
                            <p class="text-lg font-bold {{ $isAuthenticated ? 'text-green-600' : 'text-red-600' }}">
                                {{ $isAuthenticated ? 'SÍ' : 'NO' }}
                            </p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm font-medium text-gray-600">ID de Usuario</p>
                            <p class="text-lg font-bold text-gray-800">{{ $userId ?? 'N/A' }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm font-medium text-gray-600">ID de Sesión</p>
                            <p class="text-lg font-mono text-gray-800 break-all">{{ $sessionId }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm font-medium text-gray-600">Timestamp</p>
                            <p class="text-lg text-gray-800">{{ now()->format('d/m/Y H:i:s') }}</p>
                        </div>
                    </div>
                </div>

                @if($user)
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Información del Usuario</h2>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Nombre de Usuario</p>
                                <p class="text-lg font-bold text-blue-800">{{ $user->usuario }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-600">Nombre Completo</p>
                                <p class="text-lg text-gray-800">{{ $user->nombres }} {{ $user->apellidos }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-600">Email</p>
                                <p class="text-lg text-gray-800">{{ $user->email ?? 'No especificado' }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-600">DPI</p>
                                <p class="text-lg text-gray-800">{{ $user->dpi ?? 'No especificado' }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-600">Teléfono</p>
                                <p class="text-lg text-gray-800">{{ $user->telefono ?? 'No especificado' }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-600">Es Admin</p>
                                <p class="text-lg font-bold {{ $user->is_admin ? 'text-green-600' : 'text-gray-600' }}">
                                    {{ $user->is_admin ? 'SÍ' : 'NO' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-600">Es Superusuario</p>
                                <p class="text-lg font-bold {{ $user->is_superuser ? 'text-purple-600' : 'text-gray-600' }}">
                                    {{ $user->is_superuser ? 'SÍ' : 'NO' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-600">Roles</p>
                                <p class="text-lg text-gray-800">
                                    @if($user->roles && count($user->roles) > 0)
                                        {{ implode(', ', $user->roles) }}
                                    @else
                                        Sin roles asignados
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Verificación de Base de Datos</h2>
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <p class="text-green-800">
                            ✅ El usuario se encontró correctamente en la tabla 'usuario' de la base de datos.
                        </p>
                        <p class="text-green-700 mt-2">
                            Las credenciales fueron validadas exitosamente y la sesión está activa.
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('dashboard') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                        Ir al Dashboard
                    </a>

                    <a href="{{ route('settings.profile') }}"
                       class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                        Ver Perfil
                    </a>

                    <a href="{{ route('debug.auth') }}"
                       class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                        Debug de Autenticación
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>