<?php

namespace App\Http\Controllers;

use App\Models\users;
use GuzzleHttp\Promise\Create;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteSignatureParameters;
use Illuminate\Support\Facades\DB;

class singupcontroller extends Controller
{   
    public function index() {
        $regesters = users::orderBy('id','name','email','email_verified_at','password','image')->paginate(5);
        return view("singup.index");  
    }

    public function regester(){
        return view('singup.create');
    }

    public function store(Request $request)
    {
        $signup = new users();

        $signup->Us_name=$request->input('Us_name');
        $signup->Us_email=$request->input('Us_email');
        $signup->Us_email_verified->input('Us_email_verified');
        $signup->Us_passwrod->input('Us_passwrod');
        $signup->Us_create_at->input('Us_create_at');
        $signup->Us_email_verified->input('Us_update');

        if($request->hasFile('image')){
            $file=$request->file('image');
            $extension =$file->getClientOriginalExtension();
            $filename=time().'.'. $extension;
            $signup->image=$filename;
        }
        $signup->save();
        if(!$signup){
            return redirect()->route('signup.create')->with('error','check your data agan');
        }else{
            return redirect()->route('signup.create')->with('Success','your successfully !');
        }
    }
}
