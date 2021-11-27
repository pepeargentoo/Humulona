<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Mozo
{

    public function handle($request, Closure $next)
    {

      if(Auth::user()->rol == "mozo"){
        return $next($request);
      }else{
        return redirect()->to('/');
      }

    }
}
