<?php

namespace App\Http\Controllers;

use App\Models\KegiatanTendik;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TendikDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function dashboard(){
        $kegiatan = DB::table('tbkegiatan')->where('kegNip',Auth::user()->pegNip)->whereDate('kegTgl',Carbon::today())->first();
        $dt = Carbon::now();
        $today = $dt->toDateString();
        return view('tendik.dashboard',compact('kegiatan','today'));
    }

    public function post(Request $request){
        $messages = [
            'required' => ':attribute harus diisi',
        ];
        $attributes = [
            'kegTendik'   =>  'Kegiatan Tendik',
        ];
        $this->validate($request, [
            'kegTendik'    =>  'required',
        ],$messages,$attributes);
        
        $dt = Carbon::now();
        $today = $dt->toDateTimeString();
        KegiatanTendik::create([
            'kegNip'    =>  Auth::user()->pegNip,
            'kegTgl'    =>  $today,
            'kegTendik'  =>  $request->kegTendik,
            'terakhirInput'    =>  $today,
        ]);

        $notification = array(
            'message' => 'Berhasil, kegiatan anda berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('tendik.dashboard')->with($notification);
    }

    public function update(Request $request,$kegId){
        $messages = [
            'required' => ':attribute harus diisi',
        ];
        $attributes = [
            'kegTendik'   =>  'Kegiatan Tendik',
        ];
        $this->validate($request, [
            'kegTendik'    =>  'required',
        ],$messages,$attributes);

        $dt = Carbon::now();
        $today = $dt->toDateTimeString();
        KegiatanTendik::where('kegId',$kegId)->update([
            'terakhirInput'    =>  $today,
            'kegTendik'  =>  $request->kegTendik,
        ]);

        $notification = array(
            'message' => 'Berhasil, kegiatan anda berhasil diperbarui!',
            'alert-type' => 'success'
        );
        return redirect()->route('tendik.dashboard')->with($notification);
    }
}
