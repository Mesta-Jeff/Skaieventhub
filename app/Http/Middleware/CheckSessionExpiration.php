<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSessionExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $sessionLifetime = config('session.lifetime');

            // Calculate when the session is about to expire
            $expirationTime = now()->subSeconds($sessionLifetime);

            // Check if the session is about to expire
            if (session('last_activity') < $expirationTime) {
                // If it's about to expire, call the logout method
                return app('App\Http\Controllers\WebAuthenticationController')->logout($request);
            }
        }
        return $next($request);
    }
}
