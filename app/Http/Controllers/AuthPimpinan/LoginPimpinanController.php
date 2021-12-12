<?php

namespace App\Http\Controllers\AuthPimpinan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tendik;

class LoginPimpinanController extends Controller
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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:pimpinan')->except(['logout','logoutPimpinan']);
    }

    public function showLoginForm(){
        return view('authPimpinan.login');
    }

    public function login(Request $request){
        $this->validate($request, [
            'pasNama' => 'required',
            'password' => 'required'
        ]);

        $credential = [
            'pasNama' => $request->pasNama,
            'password' => $request->password
        ];

        // Attempt to log the user in
        if (Auth::guard('pimpinan')->attempt($credential, $request->member)){
            // If login succesful, then redirect to their intended location
            if (Auth::guard('pimpinan')->check()) {
                if (Auth::guard('pimpinan')->user()->level_user == "kepsek") {
                    // return 'a';
                    $notification1 = array(
                        'message' => 'Berhasil, akun login sebagai kepala sekolah!',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('kepala_sekolah.dashboard')->with($notification1);;
                }elseif (Auth::guard('pimpinan')->user()->level_user == "tu") {
                    $notification2 = array(
                        'message' => 'Berhasil, akun login sebagai tata usaha!',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('tu.dashboard')->with($notification2);;
                }else {
                    Auth::logout();
                    $notification = array(
                        'message' => 'Gagal, akun anda tidak dikenali!',
                        'alert-type' => 'error'
                    );
                    return redirect()->route('pimpinan.login')->with($notification);
                }
            } else {
                    return redirect()->route('pimpinan.login')->with('error','Password salah atau akun sudah tidak aktif');
            }
        }

        // If Unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('pasNama', 'remember'));
    }

    public function username()
    {
        return 'pasNama';
    }

    public function logoutPimpinan(){
        Auth::guard('pimpinan')->logout();
        return redirect()->route('pimpinan.login');
    }
}
