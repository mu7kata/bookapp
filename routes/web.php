<?php

use Illuminate\Support\Facades\Route;
use\App\Models\Book;
use\Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    $books = Book::all();
    return view('books',['books'=> $books]);
});

Route::post('/book', function (Request $request) {
    $Validator = Validator::make($request->all(),[
        'name' => 'required|max:255',
        ]);
        if ($Validator->fails()) {
            return redirect('/')
            ->withInput()
            ->withErrors($Validator);    
        } 
        $book =new Book;
        
        $book->title=$request->name;
        $book->save();
        return redirect('/');
    });

    Route::delete('/book/{book}', function(Book $book) {
        $book ->delete();
        return redirect('/');
    });