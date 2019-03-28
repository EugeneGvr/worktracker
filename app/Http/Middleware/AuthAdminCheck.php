<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class AuthAdminCheck
{

    public function handle($request, Closure $next)
    {
      if(Auth::user()->isAdmin() == 0){
           return redirect('/forusers');
      }
      return $next($request);
    }
}
