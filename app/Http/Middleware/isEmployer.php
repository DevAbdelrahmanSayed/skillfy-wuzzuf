<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isEmployer
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->user_type == 'employer') {
            return $next($request);
        }

        return redirect('/home/jobs'); // Redirect to the appropriate route for seekers
    }
}
