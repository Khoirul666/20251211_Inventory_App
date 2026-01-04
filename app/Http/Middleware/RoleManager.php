<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // return $next($request);
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role !== $role) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak punya akses!');
        }
        return $next($request);
    }
}
