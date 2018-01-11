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


Route::get('/', 'PagesController@index')->name('home');

Route::get('/izle/{id}-{slug}', 'PagesController@izle')->name('izle');
// Bazı filmlerde isim çince falan olunca slug olmuyor.
Route::get('/izle/{id}-', 'PagesController@izle')->name('izle');

Route::get('/kategoriler', 'PagesController@kategoriler')->name('kategoriler');
Route::get('/kategori/{slug}', 'PagesController@kategori')->name('kategori');

Route::get('/arsiv', 'PagesController@arsiv');

Route::get('/add-movie-from-tmdb/{tmdb_id}', 'MovieController@addMovieFromTmDB');
Route::get('/add-up-comings', 'MovieController@addUpComings');
