<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public $table = "authors";
    public $primaryKey = "author_id";
    public $timestamps = true;
    
    protected $fillable = [
        'author_name'
    ];

    public function books() {
        return $this->hasMany('App\Book', 'book_id', 'author_id');
    }
}
