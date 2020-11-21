<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use App\Book;
use App\Author;

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
}
