<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Hash;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckDefaultPasswordMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && Hash::check('P@ssword123', $user->password)) {
            // Chuyển hướng đến trang cập nhật mật khẩu
            return redirect()->route('password.update')->with('warning', 'Please update your password.');
        }

        return $next($request);
    }
}
