<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            // Jika user adalah admin
            if (auth()->user()->role === 'admin') {
                return redirect('/dashboard');
            }
            
            // Jika user adalah customer
            if (auth()->user()->role === 'customer') {
                return redirect('/');
            }
        }

        return $next($request);
    }
} 