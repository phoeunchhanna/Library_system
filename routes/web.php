<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\BorrowedController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\homecontroller;
use App\Http\Controllers\logincontroller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/admin/home',[homecontroller::class,'home'])->name('home');

//Category

Route::resource('/admin/categories', CategoryController::class);
Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/admin/categories/create/save', [CategoryController::class, 'store'])->name('category.store');
Route::get('/admin/categories/edit/{id}/{name}', [CategoryController::class, 'edit'])->name('category.edit');
Route::patch('/admin/categories/update/{id}/{name}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/admin/categories/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');


//Auhtor

Route::resource('/admin/authors', AuthorController::class);
Route::get('/admin/authors/create', [AuthorController::class, 'create'])->name('authors.create');
Route::post('/admin/authors/create/save', [AuthorController::class, 'store'])->name('authors.store');
Route::get('/admin/authors/edit/{id}/{name}', [AuthorController::class, 'edit'])->name('authors.edit');
Route::patch('/admin/authors/update/{id}/{name}', [AuthorController::class, 'update'])->name('authors.update');
Route::delete('/admin/authors/delete/{id}', [AuthorController::class, 'delete'])->name('authors.delete');

//book
Route::resource('/admin/books', BookController::class);
Route::get('/admin/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/admin/books/create/save', [BookController::class, 'store'])->name('books.store');
Route::get('/admin/books/edit/{id}/{name}', [BookController::class, 'edit'])->name('books.edit');
Route::patch('/admin/books/update/{id}/{name}', [BookController::class, 'update'])->name('books.update');
Route::delete('/admin/books/delete/{id}', [BookController::class, 'delete'])->name('books.delete');

//class
Route::resource('/admin/classes', ClassController::class);
Route::get('/admin/classes/create', [ClassController::class, 'create'])->name('classes.create');
Route::post('/admin/classes/create/save', [ClassController::class, 'store'])->name('classes.store');

//Read and update
Route::get('admin/classes/edit/{id}/{name}', [ClassController::class, 'edit'])->name('classes.edit');
Route::patch('/admin/classes/update/{id}/{name}', [ClassController::class, 'update'])->name('classes.update');
//delete
Route::delete('/admin/classes/delete/{id}', [ClassController::class, 'delete'])->name('classes.delete');


//Borrow
Route::get('/admin/borrows', [BorrowController::class, 'index'])->name('borrow.index');
Route::get('/admin/borrows/create', [BorrowController::class, 'create'])->name('borrows.create');
// Route::get('/admin/borrows/{id}', [BorrowController::class, 'updateStatus']);
// Route::patch('/admin/borrows/{id}', [BorrowController::class, 'updateStatus'])->name('borrow.updateStatus');
Route::patch('/admin/borrows/status-update/{id}', [BorrowController::class, 'book_status'])->name('books.status');
Route::get('/admin/classes/edit-book-borrow-retrun/{id}/{name}', [BorrowController::class, 'edit_book_return_at'])
->name('books.edit_book_return_at');
Route::patch('/admin/classes/update-book-borrow-retrun/{id}/{name}', [BorrowController::class, 'update_book_return_at'])
->name('books.update_book_return_at');
// Route::post('/books/{id}/{name}/update_return_at', 'YourController@update_book_return_at')->name('books.update_return_at');


//borrow store
Route::post('/admin/borrows/create/save', [BorrowController::class, 'store'])->name('borrows.store');
Route::get('/admin/borrows/edit/{id}/{name}', [BorrowController::class, 'edit'])->name('borrows.edit');
Route::patch('/admin/borrows/update/{id}/{name}', [BorrowController::class, 'update'])->name('borrows.update');
Route::delete('/admin/borrows/delete/{id}', [BorrowController::class, 'delete'])->name('borrows.delete');






Route::get('/admin/borrowed', [BorrowedController::class, 'index'])->name('borrowed.index');
Route::get('/admin/returned', [BorrowedController::class, 'index2'])->name('borrowed.index2');
Route::get('/admin/student/borrows/{id}/{name}', [BorrowedController::class, 'student'])->name('borrowed.student');
Route::get('/admin/books/book-detail/{id}/{name}', [BorrowedController::class, 'bookDetail'])->name('books.bookDetail');
Route::get('/admin/books/auhtor-detail/{id}/{name}', [BorrowedController::class, 'AthorDetail'])->name('books.athorDetail');
Route::get('/admin/classes/class-detail/{id}/{name}', [BorrowedController::class, 'classDetail1'])->name('books.classDetail');

Route::get('/login',[logincontroller::class,'showformlogin'])->name('loginform');
Route::post('/login/save',[logincontroller::class ,'login'])->name('login.save');

Route::post('/logout',[logincontroller::class ,'logout'])->name('logout');



Route::get('/admin/users',[logincontroller::class,'index'])->name('users.index');
Route::get('/admin/singup/create',[logincontroller::class,'singup'])->name('users.singup');
Route::post('/admin/users/create/save', [logincontroller::class, 'store'])->name('users.store');
Route::get('/admin/users/edit/{id}/{name}', [logincontroller::class, 'edit'])->name('users.edit');
Route::patch('/admin/users/update/{id}/{name}', [logincontroller::class, 'update'])->name('users.update');
Route::delete('/admin/users/delete/{id}', [logincontroller::class, 'delete'])->name('users.delete');