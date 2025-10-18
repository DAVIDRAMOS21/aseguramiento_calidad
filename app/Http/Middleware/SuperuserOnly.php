<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperuserOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || !Auth::user()->is_superuser) {
            if ($request->expectsJson() || $request->header('X-Livewire')) {
                return response()->json([
                    'message' => 'Acceso denegado. Solo los superusuarios pueden acceder a esta funcionalidad.',
                    'errors' => [
                        'authorization' => ['Acceso denegado. Solo los superusuarios pueden acceder a esta funcionalidad.']
                    ]
                ], 403);
            }
            
            abort(403, 'Acceso denegado. Solo los superusuarios pueden acceder a esta funcionalidad.');
        }

        return $next($request);
    }
}
