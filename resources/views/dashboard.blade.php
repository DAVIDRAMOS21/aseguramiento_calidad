<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        <div class="text-center py-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                ¡Bienvenido al tablero principal!
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-300">
                Sistema de Inventario de Inmuebles
            </p>
        </div>
        
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-orange-200 bg-gradient-to-br from-orange-50 to-amber-100 dark:border-zinc-700 dark:from-zinc-800 dark:to-zinc-900">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-orange-500/30 dark:stroke-orange-400/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-green-200 bg-gradient-to-br from-green-50 to-emerald-100 dark:border-zinc-700 dark:from-zinc-800 dark:to-zinc-900">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-green-500/30 dark:stroke-green-400/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-violet-200 bg-gradient-to-br from-violet-50 to-purple-100 dark:border-zinc-700 dark:from-zinc-800 dark:to-zinc-900">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-violet-500/30 dark:stroke-violet-400/20" />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-orange-200 bg-gradient-to-br from-orange-50 to-yellow-100 dark:border-zinc-700 dark:from-zinc-800 dark:to-zinc-900">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-orange-500/30 dark:stroke-orange-400/20" />
        </div>
    </div>
</x-layouts.app>
