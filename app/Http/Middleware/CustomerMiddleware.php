<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if(!Auth::guard('customer')){
        //     return redirect()->route('customer.login');
        // }
        // return $next($request);

        if (!Auth::guard('customer')->check()) {
            return redirect()->route('customer.login');
        }
        return $next($request);
    }
}
