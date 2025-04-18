<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if( Auth::user() ){
            if( Auth::user()->role == 'user' ) {

                if( $request->route()->getName() == 'login' || $request->route()->getName() == 'register' ) {
                    return back();
                }
                return $next($request);
            }

            return back();
        }else{
            return $next($request);
        }

    }
}
