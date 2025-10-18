<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class DebugCookies
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('DebugCookies - REQUEST - Path: ' . $request->path());
        Log::info('DebugCookies - REQUEST - Cookies: ' . json_encode($request->cookies->all()));
        Log::info('DebugCookies - REQUEST - Session ID: ' . session()->getId());

        $response = $next($request);

        Log::info('DebugCookies - RESPONSE - Status: ' . $response->getStatusCode());
        Log::info('DebugCookies - RESPONSE - Headers Set-Cookie: ' . json_encode($response->headers->getCookies()));

        return $response;
    }
}
