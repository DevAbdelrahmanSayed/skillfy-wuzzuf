<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsPremiumUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->user_trial > date('Y-m-d') || Auth::user()->billing_ends > date('Y-m-d')){
            return $next($request);
        }
       return redirect()->route('create.subscribe')->with('errorMessage','please subscribe to post a jop');
    }
}
