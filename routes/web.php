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

Route::get('/', '');

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
});

Route::middleware(['admin'])->group(function () {
    Route::resource('book', 'BookController');
});

Route::post('pagination/fetch', 'HomeController@fetch')
     ->name('pagination.fetch');
