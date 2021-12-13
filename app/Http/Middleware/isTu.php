<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isTu
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
        if($request->guard('pimpinan')->user() && $request->guard('pimpinan')->user()->level_user == 'tu'){
            return $next($request);
        }
        $notification = array(
            'message' => 'Gagal, anda tidak memiliki akses tata usaha!',
            'alert-type' => 'error'
        );
        return redirect()->route('login')->with($notification);
    }
}
