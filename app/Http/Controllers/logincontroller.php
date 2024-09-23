<?php

namespace App\Http\Controllers;


use App\Models\user1;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class logincontroller extends Controller
{
    // public function showformlogin(){
    //     return view('login.login');
    // }

    // public function login(Request $request){
    //     $user = DB::table('users')->where('email', $request->txt_email)->first();

    //     if ($user && $user->password === $request->txt_pwd) {
    //         return redirect()->route('home')->with('');
    //     } else {
    //         return redirect()->route('loginform')->with('error', 'Login failed.');
    //     }


    
    //     }

    //     public function logout(){
    //         return view('login.login');
    //     }


  



    public function showFormLogin()
    {
        return view('login.login');
    }

     public function login(Request $request){
        $user = DB::table('users')->where('email', $request->txt_email)->first();

        if ($user && $user->password === $request->txt_pwd) {
            return redirect()->route('home')->with('');
        } else {
            return redirect()->route('loginform')->with('error', 'Login failed.');
        }
     }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('loginform'); // Redirect to login form after logout
    }




    public function singup()
    {
        return view('login.signup');
    }




    public function index(){
        $users = users::orderBy('id', 'DESC')->paginate(5);
        return view('login.index')->with('users', $users);
    }


    

    public function store(Request $request){

        $existingUser = users::where('name', $request->input('name'))->first();
    
        if ($existingUser) {
            return redirect()->route('users.singup')->with('duplicate', 'User already exists. Cannot create duplicate.');
        }

      
    
        $users = new users();
        $users->name = $request->input('name');
        $users->email = $request->input('email'); // Assuming 'email' is the correct field name
        // $user->password = bcrypt($request->input('password')); // Use bcrypt to hash the password
        $users->password = $request->input('password');
        $users->usertype = $request->input('usertype');
    
             
 
    
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('photo/users/',  $filename);
            $users->image = $filename;
        }
        

   

     
     
        if($users){
            return redirect()->route('users.singup')->with('success', 'User has been created successfully'); 
        } else {
            return redirect()->route('users.singup')->with('error', 'User creation failed.');
        }   
    }


    public function edit($id){
        $users = users::find($id);

        return view('login.edit', compact('users'));
    }

    public function update(Request $request, $id, $name){

        $users = users::find($id);

        // $existingUser = user1::where('name', $request->input('name'))->first();
    
        // if ($existingUser) {
        //     return redirect()->route('users.singup')->with('duplicate', 'User already exists. Cannot create duplicate.');
        // }

    
        if(!$users){
            return redirect()->route('users.edit')->with('error', 'User borrow not found!');
        }
    
        // Update the attributes
        $users->name = $request->input('name');
        $users->email = $request->input('email'); 
        // $user->password = bcrypt($request->input('password')); // Use bcrypt to hash the password
        $users->password = $request->input('password');
        $users->usertype = $request->input('usertype');
    
    
        if($request->hasFile('image')){
            $imagePath = public_path('photo/user/') . $users->image;
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('photo/user',  $filename);
            $users->image = $filename;
        }
    
            $users->save();
    
        return redirect()->route('users.edit',  ['id' => $id, 'name' => $name])->with('success', 'Uers borrow book has been updated successfully!');
    }

    public function delete($id)
    {
        $user = users::find($id);

        if (!$user) {
            return redirect()->route('users.index')->with('error', 'Student not found');
        }

        $imagePath = public_path('photo/user/') . $user->image;
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }


        $user->delete();

        return redirect()->route('users.index')->with('success', 'Student has been deleted successfully');
        
    }
    
        
}

