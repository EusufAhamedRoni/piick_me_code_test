<?php

namespace App\Http\Middleware;


use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class isActive
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
        if(Auth::user()->expire_date!=null && Auth::user()->expire_date>=Carbon::now() or Auth::user()->isSuperUser()){
            return $next($request);
        }else{
            return redirect()->route('active.key');
        }
    }
}
