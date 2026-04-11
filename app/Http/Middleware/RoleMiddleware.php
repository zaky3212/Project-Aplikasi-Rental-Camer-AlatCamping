<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Cek apakah user udah login dan rolenya sesuai
        if ($request->user()->role !== $role) {
            // Kalau salah kamar, tendang ke dashboard masing-masing
            if ($request->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            if ($request->user()->role === 'pelanggan') {
                return redirect()->route('pelanggan.dashboard');
            }
        }

        return $next($request);
    }
}
