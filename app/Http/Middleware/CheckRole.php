<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{

    protected $redirectTo = '/suca';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {

        if(Auth::check()) {
            if (Auth::user()->hasRole($role)) {
                return $next($request);
            }else{
              //return redirect('/login2');
            }
        }

       // return redirect('/login');
    }
}
