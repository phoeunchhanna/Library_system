<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\borrowBook;
use App\Models\classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class BorrowController extends Controller
{
    public function index(){
        $borrows = borrowBook::orderBy('id', 'DESC')->paginate(5);
        return view('borrow.index')->with('borrows', $borrows);
    }


    public function book_status(Request $request, $id){
        $borrow = BorrowBook::find($id);
    
        if ($borrow) {
            // Toggle the status using the logical NOT operator
            $status = !$borrow->status; 

            $borrow->update(['status' => $status]) == 1 ? 0:1;
            // $borrows = borrowBook::findOrFail($id);

            // if ($status == 0) {
            //     return view('borrow.edit_book_return_at', compact('borrows'));
            // }
            
            return redirect()->route('borrow.index')->with('success', 'Status updated successfully');
        } else {
            
            return redirect()->route('borrow.index')->with('error', 'Borrow record not found');
        }


    }

    //updaet when student return book
    public function edit_book_return_at($id){
        $borrows = borrowBook::findOrFail($id);
        return view('borrow.edit_book_return_at', compact('borrows'));
    }

    public function update_book_return_at(Request $request, $id, $name){
        $borrows =  borrowBook::find($id);  
        $borrows->returned_at = $request->input('returned_at');
        $borrows->update();
    
        return redirect()->route('books.edit_book_return_at', ['id' => $id , 'name' => $name])->with('success', 'Returned Date has been updated successfully!');
        
    }



    //create borrows
    public function create(){
        $books = book::all();
        $classes = classes::all();
        return view('borrow.create', compact('books', 'classes'));
    }
  
    public function store(Request $request){

        $borrows = new borrowBook();
      
        $borrows->name = $request->input('name');
        $borrows->gender = $request->input('gender');
        $borrows->phone = $request->input('phone');
        $borrows->address = $request->input('address');
        $borrows->book_id = $request->input('book_id');
        $borrows->class_id = $request->input('class_id');
        $borrows->borrowed_at = $request->input('borrowed_at');
        $borrows->returned_at = $request->input('returned_at');
        $borrows->booking = $request->input('booking');
        $borrows->status = $request->input('status');
    
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('photo/borrow',  $filename);
            $borrows->image = $filename;
        }
        
        // Use create() instead of update()
        $borrows->save();
    
        if(!$borrows){
            return redirect()->route('borrows.create')->with('error', 'Student has been created fail!');
        } else {
            return redirect()->route('borrows.create')->with('success', 'Student borrow book has been created successfully!');
        }
    }


    //update borows book
    public function edit($id)
    {
        $borrows = borrowBook::find($id);

        if (!$borrows) {
            return redirect()->route('borrow.index')->with('error', 'Enrollment not found.');
        }

        $classes = classes::all();
        $books = book::all();
      

        return view('borrow.edit', compact('borrows', 'classes', 'books'));
    }

    public function update(Request $request, $id, $name){

        // Find the existing borrowBook record
        $borrows = borrowBook::find($id);
    
        if(!$borrows){
            return redirect()->route('borrows.create')->with('error', 'Student borrow not found!');
        }
    
        // Update the attributes
        $borrows->name = $request->input('name');
        $borrows->gender = $request->input('gender');
        $borrows->phone = $request->input('phone');
        $borrows->address = $request->input('address');
        $borrows->book_id = $request->input('book_id');
        $borrows->class_id = $request->input('class_id');
        $borrows->borrowed_at = $request->input('borrowed_at');
        $borrows->returned_at = $request->input('returned_at');
        $borrows->booking = $request->input('booking');
        $borrows->status = $request->input('status');
    
        if($request->hasFile('image')){
            $imagePath = public_path('photo/student/') . $borrows->image;
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('photo/borrow',  $filename);
            $borrows->image = $filename;
        }
    
        // Save the updated record
        $borrows->save();
    
        return redirect()->route('borrows.edit',  ['id' => $id, 'name' => $name])->with('success', 'Student borrow book has been updated successfully!');
    }
    

    public function delete($id)
    {
        $borrow = borrowBook::find($id);

        if (!$borrow) {
           return "error";
        }
        $imagePath = public_path('photo/borrow/') . $borrow->image;
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }


        $borrow->delete();

        return redirect('/admin/borrows')->with('success', 'Student borrow has been deleted successfully');
        
    }
    

}
