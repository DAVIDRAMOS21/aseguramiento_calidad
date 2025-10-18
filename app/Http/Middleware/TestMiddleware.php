<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class TestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('TestMiddleware - Request URI: ' . $request->getRequestUri());
        Log::info('TestMiddleware - Auth::check(): ' . (Auth::check() ? 'true' : 'false'));
        Log::info('TestMiddleware - Auth::id(): ' . Auth::id());
        Log::info('TestMiddleware - Session ID: ' . session()->getId());
        Log::info('TestMiddleware - Session auth key: ' . session()->get('login_web_' . sha1('web')));

        return $next($request);
    }
}
