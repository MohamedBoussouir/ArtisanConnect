<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (empty(auth()->user()->roles)) {
            return redirect('/');
        }

        $role = auth()->user()->roles;

       
        if (
            ($role === 'Admin' && ($request->is('admin') || $request->is('admin/*'))) ||
            ($role === 'artisan' && ($request->is('artisan') || $request->is('artisan/*'))) ||
            ($role === 'client' && ($request->is('client') || $request->is('client/*')))
        ) {
            return $next($request);
        }

        
        switch ($role) {
            case 'Admin':
                return redirect()->route('admin.dashboard');
            case 'artisan':
                return redirect()->route('artisan.dashboard');
            case 'client':
                return redirect()->route('client');
            default:
                return redirect('/');
        }
    }
}
