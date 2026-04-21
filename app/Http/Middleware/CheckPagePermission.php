<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPagePermission
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Admin selalu bisa akses semua halaman (case-insensitive)
        if ($user->hasRole('admin')) {
            return $next($request);
        }

        // Check jika user memiliki permission
        if ($user->hasPermissionTo($permission)) {
            return $next($request);
        }

        abort(403, 'Anda tidak memiliki akses ke halaman ini');
    }
}
