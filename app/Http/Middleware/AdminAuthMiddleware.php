<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
         //user login middleware / user can not go back log in or register page
         if (!empty(Auth::user())) {
            if(url()->current() == route('auth#loginPage') || url()->current() == route('auth#registerPage') ){
                return back();
            };
            //user and admin are can go his page / user can not go admin page and admin too
            if(Auth::user()->role == 'user'){
                return back();
            }

            return $next($request);
        }

        return $next($request);

        }


}
