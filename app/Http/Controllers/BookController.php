<?php

namespace App\Http\Controllers;

use App\Models\author;
use App\Models\book;
use App\Models\category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
    public function index(){
        $books = book::orderBy('id', 'DESC')->paginate(5);
        return view('book.index')->with('books', $books);
    }

    public function create(){
        $categories = category::all();
        $authors = author::all();
        return view('book.create', compact('categories', 'authors'));
    }


    
    public function store(Request $request)
    {
     
        // $existingClass = book::where('name', $request->input('name'))->first();

        // if ($existingClass) {
        //     return redirect()->route('books.create')->with('duplicate', 'Book already exists. Cannot create duplicate.');
        // }
        $books = new book();
        $books->name = $request->input('name');
        $books->category_id = $request->input('category_id');
        $books->author_id = $request->input('author_id');
        $books->personalize = $request->input('personalize');
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('photo/book', $filename);
            $books->image = $filename;
        }
        $books->save();
        return redirect()->route('books.create')->with('success', 'Book has been created successfully');
    }

    public function edit($id){
        $books = book::find($id);

        if (!$books) {
            return redirect()->route('enrollments.index')->with('error', 'Enrollment not found.');
        }

        $categories = category::all();
        $authors = author::all();
        

        return view('book.edit', compact('books', 'categories', 'authors'));
        
    }




                
 
        


    public function update(Request $request, $id, $name) {


        
        $book = Book::find($id);

        $existingClass = Book::where([
            ['name', $request->input('name')],
            ['category_id', $request->input('category_id')],
            ['author_id', $request->input('author_id')],
            ['personalize', $request->input('personalize')],
            ['image', $request->input('image')],
        ])->first();
        
        if ($existingClass) {
            return redirect()->route('books.create')->with('duplicate', 'Book already exists. Cannot create duplicate.');
        }
    
        if (!$book) {
            return redirect()->route('books.edit', ['id' => $id, 'name' => $name])->with('error', 'Book update failed. Book not found.');
        }
    
        $book->name = $request->input('name');
        $book->category_id = $request->input('category_id');
        $book->author_id = $request->input('author_id');
        $book->personalize = $request->input('personalize');
    
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            $imagePath = public_path('photo/book/') . $book->image;
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
    
            // Upload the new image
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('photo/book', $filename);
            $book->image = $filename;
        }
    
        $book->update();
    
        return redirect()->route('books.edit', ['id' => $id, 'name' => $name])->with('success', 'Book has been updated successfully!');
    }
    
    public function delete($id)
    {
        $book = book::find($id);

        if (!$book) {
            return redirect()->route('books.index')->with('error', 'book not found');
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'book has been deleted successfully');
        
    }
    
}
