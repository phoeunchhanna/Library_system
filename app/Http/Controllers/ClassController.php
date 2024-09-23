<?php

namespace App\Http\Controllers;

use App\Models\classes;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index(){
        $classes = classes::orderBy('id', 'DESC')->paginate(5);
        return view('classes.index')->with('classes', $classes);
    }

    public function create(){
        return view('classes.create');
    }
 
    public function store(Request $request){

        $existingClass = Classes::where('name', $request->input('name'))->first();

        if ($existingClass) {
            return redirect()->route('classes.create')->with('duplicate', 'Class already exists. Cannot create duplicate.');
        }

        $classes = new classes(); 
        if(!$classes){
            return redirect()->route('classes.create')->with('error', 'Class has been created Fail.');
        }
            $classes->name = $request->input('name');
            $classes->title = $request->input('title');     
            $classes->save();
            return redirect()->route('classes.create')->with('success', 'Class has been created successfully');     
    }

    public function edit($id){
        $classes = classes::findOrFail($id);
        return view('classes.edit', compact('classes'));
    }

    public function update(Request $request, $id, $name)
    {
        $existingClass = Classes::where('name', $request->input('name'))->first();

        if ($existingClass) {
            return redirect()->route('classes.create')->with('duplicate', 'Class already exists. Cannot create duplicate.');
        }

        $classes = Classes::find($id);
    
        if (!$classes) {
            return redirect()->route('classes.edit', ['id' => $id , 'name' => $name])->with('error', 'Class update failed. Class not found.');
        }
    
        $classes->name = $request->input('name');
        $classes->title = $request->input('title');
    
        $classes->update();
    
        return redirect()->route('classes.edit', ['id' => $id , 'name' => $name])->with('success', 'Categpry has been updated successfully!');
    }


    
    public function delete($id)
    {
        $classe = classes::find($id);

        if (!$classe) {
            return redirect()->route('classes.index')->with('error', 'Student not found');
        }

        $classe->delete();

        return redirect()->route('classes.index')->with('success', 'Student has been deleted successfully');
        
    }
}
