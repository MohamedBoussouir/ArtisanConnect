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
        if (empty(Auth()->user()->roles)) {
            return redirect('/');
        }
        $role = (Auth()->user()->roles);
        if (
            ($role === 'Admin' && $request->is('admin/*')) ||
            ($role === 'artisan' && $request->is('artisan/*')) ||
            ($role === 'client' && $request->is('client/*'))
        ) {
            return $next($request);
        }
        switch (Auth()->user()->roles) {
            case 'Admin':
                // echo 'Admin';
                return redirect()->route('admin.dashboard');
                break;
            case 'artisan':
                // echo 'artisan';
                return redirect()->route('artisan.dashboard');
                break;
            case 'client':
                // echo 'client';
                return redirect()->route('client.dashboard');
                break;
        }

        return $next($request);
    }
}
