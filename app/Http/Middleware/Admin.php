<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Admin
{

    public function handle($request, Closure $next)
    {
      if(Auth::user()->rol == "admin"){
        return $next($request);
      }else{
        return redirect()->to('/');
      }
    }
}
