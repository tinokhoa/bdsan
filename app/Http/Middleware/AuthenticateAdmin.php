<?php

namespace App\Http\Middleware;

use Closure;

//Auth Facade
use Auth;

class AuthenticateAdmin
{
    public function handle($request, Closure $next)
    {
        if (! Auth::guard('admin')->check()) {
            return redirect(route('admin.login'));
        }
        
        return $next($request);
    }
}