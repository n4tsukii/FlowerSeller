<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class LoginMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            toastr()->error('Please login to access admin panel.');
            return redirect()->route('website.getlogin');
        } else {
            $user = Auth::user();
            if ($user->roles != "admin") {
                toastr()->error('Access denied. Admin privileges required.');
                return redirect()->route('site.home');
            }
        }
        return $next($request);
    }
    
}