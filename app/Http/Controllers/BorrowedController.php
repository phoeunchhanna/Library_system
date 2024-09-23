<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\borrowBook;
use App\Models\classes;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class BorrowedController extends Controller
{
    public function index(){
        $borrowed = borrowBook::where('status', 0)->orderBy('id', 'DESC')->paginate(5);
        return view('borrowed.index')->with('borrowed', $borrowed);
    }
    
    public function index2(){
        $returned = borrowBook::where('status', 1)->orderBy('id', 'DESC')->paginate(5);
        return view('borrowed.index2')->with('returned', $returned);
    }

    public function student($id, $name){

        
        $students = borrowBook::where('name', $name)->get();
        
        
        return view('borrowed.student', compact('students'));
    }
    

    public function bookDetail($id, $name){
        $bookdetail = borrowBook::where('book_id', $id)->get();
        return view('borrowed.bookdetail', compact('bookdetail'));
    }
    
   

    public function AthorDetail($id, $name){
        $athorDetail = Book::where('author_id', $id)->paginate(5); // Adjust the number based on your preferences
        return view('borrowed.athorDetail', compact('athorDetail'));
    }
    

  
    public function classDetail1($id, $name){
        $classDetail = borrowBook::where('class_id', $id)->paginate(5);
        return view('borrowed.classDetail', compact('classDetail'));
    }
    
    
    
}
