<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Redirect;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       
            if (!Auth::check()) 
            return redirect('login');
            else
            return $next($request);
  

    }
}
