<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'author_id' => factory(\App\Author::class)->create(),
        'book_name' => $faker->name        
    ];
});
