<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // print_r($guard);
        switch($guard)
        {
          case 'user':
            if(Auth::guard($guard)->check()) {
              return redirect('/guru');
            }
            break;
          case 'siswa':
            if(Auth::guard($guard)->check()) {
              return redirect('/siswa');
            }
            break;
          case 'admin':
            if(Auth::guard($guard)->check()) {
              return redirect('/admin');
            }
          break;
          default:
            if(Auth::guard($guard)->check()) {
              return redirect('/')->with('status', 'error');
            }
            break;
        }
        return $next($request);
    }
}
