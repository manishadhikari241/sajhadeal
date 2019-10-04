<?php

namespace App\Http\Middleware;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;

class UserMiddleware
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
        if (Sentinel::check()) {
            if (Sentinel::getUser()->roles->first()->slug == "user" or Sentinel::getUser()->roles->first()->slug == "admin") {
                return $next($request);
            } else {
                return redirect('/login');
            }
        }
        else{
            return redirect('/login');
        }
    }
}
