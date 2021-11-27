<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class cocina
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
      if(Auth::user()->rol == "cocina"){
        return $next($request);
      }else{
        return redirect()->to('/');
      }
    }
}
