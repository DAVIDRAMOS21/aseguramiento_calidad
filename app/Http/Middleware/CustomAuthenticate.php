<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CustomAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        Log::info('CustomAuthenticate - Checking authentication');
        Log::info('CustomAuthenticate - Auth::check(): ' . (Auth::check() ? 'true' : 'false'));
        Log::info('CustomAuthenticate - Auth::id(): ' . Auth::id());
        Log::info('CustomAuthenticate - Session ID: ' . session()->getId());

        if (! Auth::check()) {
            Log::info('CustomAuthenticate - User not authenticated, redirecting to login');

            if ($request->expectsJson()) {
                throw new AuthenticationException('Unauthenticated.');
            }

            return redirect()->guest(route('login'));
        }

        Log::info('CustomAuthenticate - User authenticated, proceeding');

        return $next($request);
    }
}