<?php
// App\Http\Middleware\EnsureUserIsLoggedIn.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsLoggedIn
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('user_id')) {
            return redirect()->route('login')->with('warning', 'Please log in to access this page.');
        }

        return $next($request);
    }
}

?>