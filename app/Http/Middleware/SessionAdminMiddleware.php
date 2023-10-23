<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('admin_id')) {
            // No active session, admin is unauthenticated
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // If the session exists, you can consider the user as authenticated.
        // You can perform additional checks as needed.

        return $next($request);
    }
}
