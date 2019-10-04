<?php

namespace App\Http\Middleware;

use Closure;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Log;

class superAdminMiddleware
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
        if(Sentinel::check() && Sentinel::getUser()->roles->first()->slug == 'superAdmin') {

            return $next($request);
        }
        else{
            return redirect('/');
        }
    }
}
