<?php
namespace App\Repositories;

use App\Book;

class Books {
    public function all()
    {
        return Book::with('author')->get();
    }
}