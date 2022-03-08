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







class AdminCtrl extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

	public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(!Session::get('login-adm')){
                return redirect('/login')->with('alert-danger','Dilarang Masuk Terlarang');
            }
            return $next($request);
        });
        
    }
    public function __invoke(Request $request)
    {
       

    }

    function index(){
          return view('admin.admin');
    }


    // pasien
    function pasien(){
        return view('pasien.pasien');
    }

    function pasien_act(Request $request){
         $request->validate([
            'nama' => 'required',
            'nik' => 'required'
        ]);

         $date=date('Y-m-d');

         DB::table('pasien')->insert([
            'nama' => $request->nama,
            'nik' =>$request->nik,
            'kartu_berobat'=> $request->kartu,
            'tanggal_lahir'=> $request->tgl_lhr,
            'tempat_lahir' => $request->tmp_lhr,
            'agama'=> $request->agama,
            'pekerjaan'=> $request->kerja,
            'alamat'=> $request->alamat,
            'nama_kepala'=> $request->kepala,
            'tgl_registrasi' => $date,
            'status' => 1
        ]);

        return redirect('/dashboard/pasien/data')->with('alert-success','Data diri anda sudah terkirim');

    }

     function pasien_data(){
         $data = Pasien::orderBy('id','asc')->get();
        return view('admin.pasien_data',[
            'data' =>$data
        ]);
    }
    function pasien_edit(){
        
    }

    function pasien_update(){
        
    }
    function pasien_delete(){
        
    }


    // pegawai

    function pegawai(){
        $data=Pegawai::orderBy('id','asc')->get();
        return view('admin.pegawai_data',[
            'data' =>$data
        ]);

    }

    function pegawai_add(){
        return view('admin.pegawai_add');
    }

    function pegawai_act(Request $request){
            $request->validate([
                'nama' => 'required',
                'nip' => 'required'
            ]);

    }

    function pegawai_edit(){}
    function pegawai_update(){}

    function pegawai_delete(){}


    // data poli

function poli(){
    $data=Poli::orderBy('id','asc')->get();
        return view('admin.poli_data',[
            'data' =>$data
        ]);
}
function  poli_act(Request $request){
       $request->validate([
            'nama' => 'required',
        ]);

         DB::table('poli')->insert([
            'prosedur' => $request->nama,
        ]);
        return redirect('/dashboard/poli/data')->with('alert-success','Data Berhasil');

}
function  poli_edit($id){
    $dpoli=Poli::where('id',$id)->get();
       $data=Poli::orderBy('id','asc')->get();
        return view('admin.poli_edit',[
            'data' =>$data,
            'poli' => $dpoli
        ]);
}
function  poli_update(Request $request){
        $request->validate([
            'nama' => 'required',
        ]);

        $id=$request->id;
         DB::table('poli')->where('id',$id)->update([
            'prosedur' => $request->nama,
        ]);
        return redirect('/dashboard/poli/data')->with('alert-success','Data Berhasil');


}
function  poli_delete($id){
         Poli::where('id',$id)->delete();
        return redirect('/dashboard/poli/data')->with('alert-success','Data Berhasil');
       
}


// rekam medis
function  rekam(){
    $data=Rekam::orderBy('id','asc')->get();
        return view('admin.rekam_data',[
            'data' =>$data
        ]);
}
function  rekam_add(){
    return view('admin.rekam_add');
}
function  rekam_act(Request $request){
    $request->validate([
            'pasien' => 'required',
    ]);
    $kode_rekam=mt_rand(100000, 999999);

        $date=date('Y-m-d');
        if($request->cek_rujuk == "1"){
            // jika dirujuk

             DB::table('rekam')->insert([
                    'id_pasien' => $request->pasien,
                    'kode_rekam'=> $kode_rekam,
                    'id_poli'=> $request->poli,
                    'petugas' => $request->pegawai,
                    'kartu_berobat' => $request->kartu,
                    'tanggal' => $date,
                    'diagnosa' => $request->diagnosa,
                    'pengobatan' => $request->pengobatan,
                    'tanggal_keluar' =>$request->tgl_keluar,
                    'status_rujuk' => 1,
                    'status' => 1
            ]);

             DB::table('rujukan')->insert([
                 'kartu_berobat'=> $request->kartu,
                 'id_pasien' => $request->pasien,
                 'id_rekam'=> $kode_rekam,
                'rs_tujuan' => $request->rs_rujuk,
                'tgl_surat' => $request->tgl_rujuk
            ]);

        }else{
            if($request->kartu_berobat == "3"){
              DB::table('rekam')->insert([
                    'id_pasien' => $request->pasien,
                    'kode_rekam'=> $kode_rekam,
                    'id_poli'=> $request->poli,
                     'petugas' => $request->pegawai,
                    'kartu_berobat' => $request->kartu,
                    'tanggal' => $date,
                    'uang_diterima'=>"30000",
                    'diagnosa' => $request->diagnosa,
                    'pengobatan' => $request->pengobatan,
                    'tanggal_keluar' =>$request->tgl_keluar,
                    'status_rujuk' => 0,
                    'status' => 1
            ]);  

            }else{
                DB::table('rekam')->insert([
                    'id_pasien' => $request->pasien,
                    'kode_rekam'=> $kode_rekam,
                    'id_poli'=> $request->poli,
                     'petugas' => $request->pegawai,
                    'uang_diterima'=>"0",
                    'kartu_berobat' => $request->kartu,
                    'tanggal' => $date,
                    'diagnosa' => $request->diagnosa,
                    'pengobatan' => $request->pengobatan,
                    'tanggal_keluar' =>$request->tgl_keluar,
                    'status_rujuk' => 0,
                    'status' => 1
            ]);
            }
           
        }
    

        return redirect('/dashboard/rekam/data')->with('alert-success','Data sudah terkirim');


}
function  rekam_edit($id){
   $data=Rekam::where('id',$id)->get();
    return view('admin.rekam_edit',[
        'data' =>$data
    ]);

}
function  rekam_update(Request $request){
    $request->validate([
            'pasien' => 'required',
    ]);
    $kode_rekam=$request->kode_rekam;
    $data_rujuk=App\Models\Rekam::where('kode_rekam',$kode_rekam)->first();


    if($data_rujuk->status_rujuk == "0"){
        if($request->cek_rujuk == "1"){
            // jika dirujuk

             DB::table('rekam')->where('kode_rekam',$kode_rekam)->update([
                    'id_pasien' => $request->pasien,
                    'id_poli'=> $request->poli,
                    'petugas' => $request->pegawai,
                    'kartu_berobat' => $request->kartu,
                    'diagnosa' => $request->diagnosa,
                    'pengobatan' => $request->pengobatan,
                    'tanggal_keluar' =>$request->tgl_keluar,
                    'status_rujuk' => 1,
                    'status' => 1
            ]);

             DB::table('rujukan')->where('id_rekam',$kode_rekam)->update([
                 'kartu_berobat'=> $request->kartu,
                 'id_pasien' => $request->pasien,
                'rs_tujuan' => $request->rs_rujuk,
                'tgl_surat' => $request->tgl_rujuk
            ]);

        }else{
           DB::table('rekam')->insert([
                    'id_pasien' => $request->pasien,
                    'id_poli'=> $request->poli,
                     'petugas' => $request->pegawai,
                    'kartu_berobat' => $request->kartu,
                    'tanggal' => $date,
                    'diagnosa' => $request->diagnosa,
                    'pengobatan' => $request->pengobatan,
                    'tanggal_keluar' =>$request->tgl_keluar,
                    'status_rujuk' => 0,
                    'status' => 1
            ]);
        }


    }

        return redirect('/dashboard/rekam/data')->with('alert-success','Data sudah terkirim');


}
function  rekam_delete(){}


// data rujukan
function  rujukan(){
   $data=Rekam::orderBy('id','asc')->where('status_rujuk','1')->get();
        return view('admin.rujukan',[
            'data' =>$data
        ]);
}


function cetak_kwitansi($id){
    $dt=Rekam::where('id',$id)->first();
    return view('cetak.kwitansi',[
        'dt'=> $dt
    ]);
}

function cetak_rujukan($id){
    $dt=Rujukan::where('id_rekam',$id)->first();

    return view('cetak.surat_rujuk',[
        'dt'=> $dt
    ]);
}


 function cek_rujuk(Request $request){
    $cek_status=$request->cek_rujuk;

    if($cek_status == 1){
        echo"
         <div class='form-group'>
            <label >Rumah Sakit Rujukan</label>
            <input type='text' class='form-control'  name='rs_rujuk' value='Rumah Sakit Umum Hasanuddin Kuta Cane' readonly>
        </div>
        <div class='form-group'>
            <label >Tanggal surat</label>
            <input type='date' class='form-control'  name='tgl_rujuk'>
        </div>
        ";
    }else{
        
    }

 }


}
