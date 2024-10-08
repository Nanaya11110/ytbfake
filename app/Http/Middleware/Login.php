<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Login
{
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check()) return $next($request);
        else return redirect()->route('login');
    }
}
