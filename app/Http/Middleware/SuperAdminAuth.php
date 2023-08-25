<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('/login');
        }

        $user = Auth::user();

        if ($user->role == 1) {
            return $next($request);
        }

        if ($user->role == 2) {
            return redirect()->route('/admin');
        }

        if ($user->role == 3) {
            return redirect()->route('/dept');
        }

        if ($user->role == 4) {
            return redirect()->route('/staff');
        }

        if ($user->role == 5) {
            return redirect()->route('/client');
        }
    }
}
