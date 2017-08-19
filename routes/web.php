<?php

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
    return view('welcome');
});
Route::group(['middleware' => 'auth'],function (){
    Route::get('/posts/create','PostController@create')
        ->name('post.create');
    Route::post('/posts','PostController@store');
});
Route::get('/posts','PostController@index'); //ruta post, a la clase postcontroller al metodo index
Route::get('{slug}/post','PostController@postChannel')
    ->name('postChannel');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
