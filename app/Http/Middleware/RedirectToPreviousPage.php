<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectToPreviousPage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //disable the session to be created with this urls to make sure the previous url is setup correctly
        if(url()->previous()=="http://127.0.0.1:8000/sign-in" || url()->previous()=="http://127.0.0.1:8000/sign-up" || url()->previous()=="http://127.0.0.1:8000/VerifyEmail" )
        {
            return $next($request);
        }
        $request->session()->put('previous_url', url()->previous());
        return $next($request);
    }
}
