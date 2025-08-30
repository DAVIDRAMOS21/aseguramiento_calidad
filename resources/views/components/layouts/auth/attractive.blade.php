<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-yellow-100 dark:from-gray-900 dark:via-gray-800 dark:to-orange-900 antialiased">
        <div class="min-h-screen flex">
            <!-- Panel izquierdo con diseño atractivo -->
            <div class="hidden lg:flex lg:flex-1 lg:flex-col lg:justify-center lg:px-8 relative overflow-hidden">
                <!-- Fondo decorativo -->
                <div class="absolute inset-0 bg-gradient-to-br from-orange-600 via-violet-600 to-green-700"></div>
                <div class="absolute inset-0 bg-black/20"></div>
                
                <!-- Patrones decorativos -->
                <div class="absolute top-0 left-0 w-full h-full">
                    <div class="absolute top-10 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-10 right-10 w-96 h-96 bg-green-400/20 rounded-full blur-3xl"></div>
                    <div class="absolute top-1/2 left-1/4 w-64 h-64 bg-violet-400/15 rounded-full blur-2xl"></div>
                </div>
                
                <!-- Contenido del panel -->
                <div class="relative z-10 text-white px-8">
                    <div class="max-w-md">
                        <h1 class="text-4xl font-bold mb-6 bg-gradient-to-r from-white to-orange-200 bg-clip-text text-transparent">
                            Sistema de Inventario Inmuebles
                        </h1>
                        <p class="text-xl text-orange-100 mb-8">
                            Gestiona tu inventario de inmuebles de manera eficiente y profesional
                        </p>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-6 h-6 bg-green-400 rounded-full flex items-center justify-center">
                                        <svg class="w-3 h-3 text-green-800" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-orange-100">Control total de tu inventario</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-6 h-6 bg-green-400 rounded-full flex items-center justify-center">
                                        <svg class="w-3 h-3 text-green-800" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-orange-100">Reportes detallados y análisis</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-6 h-6 bg-green-400 rounded-full flex items-center justify-center">
                                        <svg class="w-3 h-3 text-green-800" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-orange-100">Interfaz moderna e intuitiva</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel derecho con formulario de login -->
            <div class="flex flex-1 flex-col justify-center px-6 py-12 lg:px-8">
                <div class="mx-auto w-full max-w-md">
                    <!-- Logo y título -->
                    <div class="text-center mb-8">
                        <div class="flex justify-center mb-6">
                            <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-r from-orange-500 to-violet-600 shadow-lg">
                                <x-app-logo-icon class="size-8 fill-current text-white" />
                            </div>
                        </div>
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                            Bienvenido de vuelta
                        </h2>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            Ingresa a tu cuenta para continuar
                        </p>
                    </div>

                    <!-- Formulario -->
                    <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700">
                        {{ $slot }}
                    </div>

                    <!-- Footer -->
                    <div class="text-center mt-8">
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            © {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>