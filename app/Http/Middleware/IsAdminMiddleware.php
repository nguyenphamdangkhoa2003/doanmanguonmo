<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and has an admin role
        if (Auth::check() && Auth::user()->role == "admin") {
            return $next($request); // Proceed if the user is an admin
        }

        // Redirect or abort if the user is not an admin
        return redirect('/')->with('error', 'Unauthorized access. Admins only.');
    }
}
