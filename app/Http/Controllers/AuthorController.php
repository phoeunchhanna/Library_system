<?php

namespace App\Http\Controllers;

use App\Models\author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    
    public function index(){
        $authors = author::orderBy('id', 'DESC')->paginate(5);
        return view('author.index')->with('authors', $authors);
    }

    public function create(){
        return view('author.create');
    }

    public function store(Request $request){

        $existingClass = author::where('name', $request->input('name'))->first();

        if ($existingClass) {
            return redirect()->route('authors.create')->with('duplicate', 'Author already exists. Cannot create duplicate.');
        }
        $authors = new author(); 
        $authors->name = $request->input('name');
        $authors->gender = $request->input('gender');   
        $authors->Nationality = $request->input('Nationality');      
        $authors->save();

        if($authors){
            return redirect()->route('authors.create')->with('success', 'Author has been created successfully'); 
        } else {
            return redirect()->route('authors.create')->with('error', 'author creation failed.');
        }
           
    }
    
    
    public function edit($id){
        $authors = author::findOrFail($id);
        return view('author.edit', compact('authors'));
    }

    
    public function update(Request $request, $id, $name)
    {
        $authors =  author::find($id);  
        $existingClass = author::where('name', $request->input('name'))->first();
        if ($existingClass) {
            return redirect()->route('authors.edit', ['id' => $id, 'name' => $name])->with('duplicate', 'Author already exists. Cannot update duplicate.');

        }
        $authors->name = $request->input('name');
        $authors->gender = $request->input('gender');   
        $authors->Nationality = $request->input('Nationality');  
        
    
        $authors->update();
        
    
        return redirect()->route('authors.edit', ['id' => $id, 'name' => $name])->with('success', 'Author has been updated successfully!');
        if (!$authors) {
            return redirect()->route('authors.edit', $id)->with('error', 'Author update failed. Categpry not found.');
        }
    }

    public function delete($id)
    {
        $author = author::find($id);

        if (!$author) {
           return "error";
        }

        $author->delete();

        return redirect('/admin/authors')->with('success', 'author has been deleted successfully');
        
    }
}
