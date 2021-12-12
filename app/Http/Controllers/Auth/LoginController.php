<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $input = $request->all();
        $messages = [
            'required' => ':attribute harus diisi',
        ];
        $attributes = [
            'pegNip'    =>  'pegNip',
            'password'    =>  'Password',
        ];
        $this->validate($request,[
            'pegNip' =>  'required',
            'password' =>  'required',
        ],$messages,$attributes);
        if (auth()->attempt(array('pegNip'   =>  $input['pegNip'], 'password' =>  $input['password'], 'pegJenisKepeg' => "Karyawan"))) {
           if (Auth::check()) {
                $notification1 = array(
                    'message' => 'Berhasil, akun login sebagai tendik!',
                    'alert-type' => 'success'
                );
                return redirect()->route('tendik.dashboard')->with($notification1);;
           } else {
                return redirect()->route('login')->with('error','Password salah atau akun sudah tidak aktif');
           }
        }else{
            $notification = array(
                'message' => 'Gagal, Password salah atau anda bukan karyawan tendik!',
                'alert-type' => 'error'
            );
            return redirect()->route('login')->with($notification);
        }
    }
}
