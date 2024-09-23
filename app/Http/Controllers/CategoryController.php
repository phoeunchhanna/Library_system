<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = category::orderBy('id', 'DESC')->paginate(5);
        return view('category.index')->with('categories', $categories);
    }

    public function create(){
        return view('category.create');
    }

    public function store(Request $request){

        $existingClass = Category::where('name', $request->input('name'))->first();

        if ($existingClass) {
            return redirect()->route('category.create')->with('duplicate', 'Class already exists. Cannot create duplicate.');
        }
        $categories = new Category(); 
        $categories->name = $request->input('name');
        $categories->title = $request->input('title');     
        $categories->save();

        if($categories){
            return redirect()->route('category.create')->with('success', 'category has been created successfully'); 
        } else {
            return redirect()->route('category.create')->with('error', 'category creation failed.');
        }
           
    }
    
    
    public function edit($id){
        $categories = category::findOrFail($id);
        return view('category.edit', compact('categories'));
    }

    
    public function update(Request $request, $id, $name)
    {
        $categories =  Category::find($id);  
        $existingClass = Category::where('name', $request->input('name'))->first();
        if ($existingClass) {
            return redirect()->route('category.edit', ['id' => $id, 'name' => $name])->with('duplicate', 'Categpry already exists. Cannot update duplicate.');

        }
        $categories->name = $request->input('name');
        $categories->title = $request->input('title');
        
    
        $categories->update();
        
    
        return redirect()->route('category.edit', ['id' => $id , 'name' => $name])->with('success', 'Categpry has been updated successfully!');
        if (!$categories) {
            return redirect()->route('category.edit', $id)->with('error', 'Class update failed. Categpry not found.');
        }
    }

    public function delete($id)
    {
        $category = category::find($id);

        if (!$category) {
           return "error";
        }

        $category->delete();

        return redirect('/admin/categories')->with('success', 'Category has been deleted successfully');
        
    }
}
