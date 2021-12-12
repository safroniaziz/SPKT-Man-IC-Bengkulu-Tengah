<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            switch ($guard){
                case 'pimpinan':
                    if (Auth::guard($guard)->check()) {
                        if (Auth::guard('pimpinan')->user()->level_user == "tu") {
                            return redirect()->route('tata_usaha.dashboard');
                        }
                        else{
                            return redirect()->route('kepala_sekolah.dashboard');
                        }
                    }
                    break;
                default:
                    if (Auth::guard($guard)->check()) {
                        // return redirect(RouteServiceProvider::HOME);
                        $notification1 = array(
                            'message' => 'Berhasil, akun login sebagai tendik!',
                            'alert-type' => 'success'
                        );
                        return redirect()->route('tendik.dashboard')->with($notification1);;
                    }
                    break;
            }
        }

        return $next($request);
    }
}
