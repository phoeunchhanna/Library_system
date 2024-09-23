<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homecontroller extends Controller
{
    public  function  home() {
        return view('home');
    }


    // public function home(Request $req){
    //     if($req->session()->get('user')){
    //         return view('home');
    //     }else{
    //         return redirect()->route('loginform');
    //     }

    // }
}
