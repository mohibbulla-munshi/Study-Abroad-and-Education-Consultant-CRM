<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    use Closure;

    public function handle($request, Closure $next, $role)
    {
        if (!auth()->check() || auth()->user()->role->name !== $role) {
            return response()->json(['message' => 'Access Denied'], 403);
        }
        return $next($request);
    }

}
