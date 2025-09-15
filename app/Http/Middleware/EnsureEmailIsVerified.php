<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerified
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
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Check if user implements MustVerifyEmail and has verified their email
        if ($user instanceof MustVerifyEmail && !$user->hasVerifiedEmail()) {
            // Redirect to verification notice page or dashboard with error
            return redirect()->route('dashboard')->with('error', 'Please verify your email address before accessing this page.');
        }

        return $next($request);
    }
}