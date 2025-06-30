<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            toastr()->error('Please login to access admin panel.');
            return redirect()->route('website.getlogin');
        }

        // Check if user has admin role
        if (auth()->user()->roles !== 'admin') {
            toastr()->error('Access denied. Admin privileges required.');
            return redirect()->route('site.home');
        }

        return $next($request);
    }
}
