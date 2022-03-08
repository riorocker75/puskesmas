<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;

use App\Models\Pasien;
use App\Models\Rekam;
use App\Models\Rujukan;
use App\Models\Kwitansi;
use App\Models\Pegawai;
use App\Models\Poli;
use App\Models\User;

class KapusCtrl extends Controller
{
  	public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(!Session::get('login-kp')){
                return redirect('/login')->with('alert-danger','Dilarang Masuk Terlarang');
            }
            return $next($request);
        });
        
    }
    
    function index(){
        return view('kepala.kepala');
    }
    function pasien(){
        $data=Pasien::orderBy('id','asc')->get();
        return view('kepala.pasien',[
            'data' =>$data
        ]);
    }


      function pegawai(){
        $data=Pegawai::orderBy('id','asc')->get();
        return view('kepala.pegawai',[
            'data' =>$data
        ]);
    }

      function poli(){
        $data=Poli::orderBy('id','asc')->get();
        return view('kepala.poli',[
            'data' =>$data
        ]);
    }

      function rujukan(){
        $data=Rekam::orderBy('id','asc')->where('status_rujuk','1')->get();
        return view('kepala.rujukan',[
            'data' =>$data
        ]);
    }





}
