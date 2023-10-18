<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visit;
use Carbon\Carbon;


class VisitMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (!$request->session()->has('visited')) {
            // Get the visitor's IP address
            $ipAddress = $request->ip();

            // Log the visit (insert a record in the database)
            Visit::create([
                'ip_address' => $ipAddress,
                'visit_date' => Carbon::now(),
                // Add any other columns you need
            ]);
            $request->session()->put('visited', true);
        }

        return $next($request);
    }
}
