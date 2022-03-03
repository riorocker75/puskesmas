<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admin extends Controller
{
      public function __construct()
    {
        // $this->middleware(function ($request, $next) {
        //     if(!Session::get('login-adm')){
        //         return redirect('login/user')->with('alert-danger','Dilarang Masuk Terlarang');
        //     }
        //     return $next($request);
        // });
        
    }
     public function __invoke(Request $request){
        return view('admin.admin');
    }



}
