<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::check()) 
        {
            if (Auth::user()->is_admin == 0) 
            {
                return $next($request); 
            }
            else
            {
                Auth::logout();
                return redirect('login')->with('message', 'Email and Password is wrong!');
            }
        }
        else 
        {
            Auth::logout();
            return redirect('login');
        }
    }

}
