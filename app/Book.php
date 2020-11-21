<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $table = "books";
    public $primaryKey = "book_id";
    public $timestamps = true;
    
    protected $fillable = [
        'book_name'
    ];
    

    public function author() {        
        return $this->belongsTo('App\Author', 'author_id', '');              
    }
}
