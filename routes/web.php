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

Route::middleware(['auth'])->group(function () {
    Route::get('/edit', 'Auth\EditController@edit')
         ->name('user.edit');
    Route::post('/edit/{user}', 'Auth\EditController@update')
         ->name('user.update');
    Route::post('book/add_favorite/{book}/{remove?}', 'BookController@toggleFavorite')
         ->name('book.toggle_favorite');
    Route::get('favorites', 'BookController@showFavorite')
         ->name('favorites');
    Route::get('book/{book}/content', 'BookController@showContent')
         ->name('book.show.content');
    Route::post('pagination/fetch', 'HomeController@fetch')
         ->name('pagination.fetch');
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
Route::fallback(function () {
    abort(404);;
});
