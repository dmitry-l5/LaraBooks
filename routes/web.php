<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\authors_list;
use App\Models\books_list;
use App\Models\link;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/function get_author_arr(){
    $books = null; 
    $books = books_list::all(); 
    $books_arr = array();
    foreach($books as $book){
        $books_arr[$book->id] = array();
        $books_arr[$book->id]['title'] = $book->title;
        $books_arr[$book->id]['authors'] = array();
        foreach( link::where('book_id', '=', $book->id)->get() as $link){
            $author = authors_list::where('id', '=', $link->author_id)->first()->full_name;
            $books_arr[$book->id]['authors'][] =  $author;
        }
    }
    return $books_arr;
}

Route::get('/', function () {
    $authors_arr = array();
    foreach(authors_list::all() as $author){
        $tmp = array();
        $tmp['id'] = $author->id;
        $tmp['full_name'] = $author->full_name;
        $tmp['books_count'] = link::where('author_id', '=', $author->id)->count();
        $authors_arr[] = $tmp;
    }
    $books_arr = get_author_arr();
    return view('index', ['authors_arr'=>$authors_arr, 'books_arr'=>$books_arr]);
});
Route::get('/edit', function(){
    $authors = null;
    $books = null;
    $authors = authors_list::all(); 
    $books = books_list::all(); 
    $books_arr = get_author_arr();
    return view('edit', ['authors'=>$authors, 'books'=>$books, 'books_arr'=>$books_arr]);
})->name('edit');
Route::post('/add_author', function(Request $request){
    //валидация ввода)
    // var_dump($request->full_name);
    if($request->full_name){   
        $author = new authors_list();
        $author->full_name = $request->full_name;
        $author->save();
    }
    return redirect()->route('edit', ['full_name'=>'ОДИН']);
});
Route::post('/add_book', function(Request $request){
    //валидация ввода)
    if($request->title){

        $book = new books_list();
        $book->title = $request->title;
        $book->save();
        if($request->authors){
            foreach($request->authors as $key=>$value){
                $link = new link();
                $link->author_id = $key;
                $link->book_id = $book->id;
                $link->save(); 
            }
        }
    }
    return redirect()->route('edit', ['full_name'=>'ОДИН']);
});
Route::post('/delete_book', function(Request $request){
    $book = books_list::where('id', '=', $request->book_id);
    $book->delete();
    return redirect()->route('edit',[]);
});
Route::post('/delete_author', function(Request $request){
    $author = authors_list::where('id', '=', $request->author_id);
    $author->delete();
    return redirect()->route('edit',[]);
});