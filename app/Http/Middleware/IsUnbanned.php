<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsUnbanned
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            if(auth()->user()->banned){
                auth()->logout();
                flash(translate("You are banned"));
                return redirect()->route("user.login");
            }elseif(auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff'){
                return redirect()->route("admin.dashboard");
            }else{
                return $next($request);
            }
        }

        return $next($request);
    }
}
