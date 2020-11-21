<?php

use Illuminate\Support\Facades\Route;

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



Route::get('/', 'BooksController@lazyLoadBooks');
Route::get('/eager-load', 'BooksController@eagerLoadBooks');
Route::get('/dependency', 'BooksController@getBooksWithDependencyinject');


Route::post('/author/create', 'AuthorController@create');
Route::put('/author/update', 'AuthorController@update');
Route::delete('/author/delete', 'AuthorController@delete');
Route::get('/author/', 'AuthorController@index');

/*App.bind("App\ReadConfig\Config", function(){
    return \App\ReadConfig\Config(config(services.User.key));
});

$config = App::make("App\ReadConfig\Config");
var_dump($config);*/