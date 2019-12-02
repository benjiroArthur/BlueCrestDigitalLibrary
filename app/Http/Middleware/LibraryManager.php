<?php

namespace App\Http\Middleware;

use Closure;

class LibraryManager
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
        if(auth()->user()->role->id == 1)
        {
            return $next($request);
        }
        else
            return redirect('/home')->with('error', 'Unauthorised Access');
    }
}
