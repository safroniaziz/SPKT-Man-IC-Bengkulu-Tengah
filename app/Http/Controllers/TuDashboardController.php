<?php

namespace App\Http\Controllers;

use App\Models\KegiatanTendik;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TuDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pimpinan');
    }
    
    public function dashboard(){
        $karyawans = DB::table('tbpegawai')->select('pegNip','pegNama')->where('pegJenisKepeg','Karyawan')->get();
        return view('tu.dashboard',compact('karyawans'));
    }

    public function detailKaryawan(Request $request){
        $dt = Carbon::now();
        $today = $dt->toDateString();
        $data['today'] = $dt->toDateString();
        $data['karyawan'] = DB::table('tbpegawai')
                            ->select('pegNip','pegNmJabatan')
                            ->where('pegNip',$request->pegNama)
                            ->first();
        $data['detail'] = DB::table('tbkegiatan')
                        ->join('tbpegawai','tbpegawai.pegNip','tbkegiatan.kegNip')
                        ->select('kegId','kegTendik','kegSaranKatu','kegSaranKatu')
                        ->whereDate('kegTgl',$today)
                        ->where('kegNip',$request->pegNama)
                        ->first();
        return $data;
    }

    public function update(Request $request){
        $messages = [
            'required' => ':attribute harus diisi',
        ];
        $attributes = [
            'komenTu'   =>  'Komentar Kepala Sekolah',
        ];
        $this->validate($request, [
            'komenTu'    =>  'required',
        ],$messages,$attributes);
        // return $request->all();

        KegiatanTendik::where('kegId',$request->kegId)->update([
            'kegSaranKatu'    =>  $request->komenTu,
        ]);
        $notification = array(
            'message' => 'Berhasil, komentar berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        $dt = Carbon::now();
        $today = $dt->toDateString();
        $data['karyawan'] = DB::table('tbpegawai')
                            ->select('pegNip','pegNmJabatan')
                            ->where('pegNip',$request->pegNama)
                            ->first();
        $data['detail'] = DB::table('tbkegiatan')
                        ->join('tbpegawai','tbpegawai.pegNip','tbkegiatan.kegNip')
                        ->select('kegId','kegTendik','kegSaranKatu','kegSaranKepsek')
                        ->whereDate('kegTgl',$today)
                        ->where('kegNip',$request->pegNama)
                        ->first();
        $karyawans = DB::table('tbpegawai')->select('pegNip','pegNama')->where('pegJenisKepeg','Karyawan')->get();
        return view('tu.dashboard')->with('success','Komentar berhasil ditambahkan')->with('data',$data)->with('today',$today)->with('karyawans',$karyawans);
    }
}
