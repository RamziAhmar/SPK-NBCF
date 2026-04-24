<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!in_array($request->user()->role, $roles)) {
            // Jika role tidak sesuai, lempar ke dashboard atau error 403
            return redirect()->route('dashboard')->with('error', 'Anda tidak punya akses.');
        }

        return $next($request);
    }
}
