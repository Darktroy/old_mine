<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Country
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
        if(!Auth::check()){
            return redirect()->back();
        }

        if(Auth::check()){
            if(Auth::user()->type != 1 && Auth::user()->type != 4){
                return redirect('/');
            }
        }
        return $next($request);
    }
}
