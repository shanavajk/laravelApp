<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use App\Book;
use App\Author;

use App\Repositories\Books;

class BooksController extends Controller
{
    public function lazyLoadBooks() {
        $books = Book::all();
        $title = "Lazy Load";
        return view("lazyload", compact('books', 'title'));
    }

    public function eagerLoadBooks() {
        $books = Book::with('author')->get();
        $title = "Eager Load";
        return view("lazyload", compact('books', 'title'));
    }


    public function getBooksWithDependencyinject(Books $books)  {
        $books = $books->all();
        $title = "Dependency Injection";
        return view("lazyload", compact('books', 'title'));        
    }
}
