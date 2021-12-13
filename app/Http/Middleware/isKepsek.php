<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isKepsek
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->guard('pimpinan')->user() && $request->guard('pimpinan')->user()->level_user == 'kepsek'){
            return $next($request);
        }
        $notification = array(
            'message' => 'Gagal, anda tidak memiliki kepala sekolah!',
            'alert-type' => 'error'
        );
        return redirect()->route('login')->with($notification);
    }
}
