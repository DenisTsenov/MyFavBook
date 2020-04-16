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

Route::get('/', 'HomeController@main');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('pagination/fetch', 'HomeController@fetch')
     ->name('pagination.fetch');

Route::middleware(['auth'])->group(function () {
    Route::get('/edit', 'Auth\EditController@edit')
         ->name('user.edit');
    Route::post('/edit/{user}', 'Auth\EditController@update')
         ->name('user.update');
    Route::post('book/add_favorite/{book}/{remove?}', 'BookController@toggleFavorite')
         ->name('book.toggle_favorite');
    Route::get('favorites', 'BookController@showFavorite')
         ->name('favorites');
    Route::get('book', 'BookController@index')
         ->name('book.index');
    Route::get('book/{book}', 'BookController@show')
         ->name('book.show');
});

Route::middleware(['admin'])->group(function () {
    Route::get('book/create', 'BookController@create')
         ->name('book.create');
    Route::post('book', 'BookController@store')
         ->name('book.store');
    Route::get('book/{book}/edit', 'BookController@edit')
         ->name('book.edit');
    Route::put('book/{book}', 'BookController@update')
         ->name('book.update');
    Route::post('book/{book}', 'BookController@destroy')
         ->name('book.destroy');

    Route::post('user/approve/{user}', 'Auth\EditController@approve')
         ->name('user.approve');

//    Route::resource('book', 'BookController');
});
