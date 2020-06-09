<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class isWali
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
        if(!$request->session()->get(0) == 'isWali' && !$request->session()->get(1) == true) {

            return back()->with(['status' =>'error', 'msg' => 'Resource hanya untuk wali kelas.']);
        } else {
            return $next($request);
        }

    }
}
