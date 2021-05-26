<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::guard()->check() === false || Auth::user()->role !== 'user'){
            return redirect('/login');
        }elseif (Auth::user()->email_verified_at == null){
            return redirect('/email/verify');
        }
        return $next($request);
    }
}
