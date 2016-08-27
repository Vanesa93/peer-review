<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class StudentMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        
        if (Auth::check() && Auth::user()->account_type==  2) {
            return $next($request);
        }

        return redirect('auth/login');
    }

}