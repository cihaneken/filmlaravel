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

use App\Movie;

// LISTELER
Route::get('/listeler', 'ListeController@listeler')->name('listeler');
Route::get('/liste/{id}-{slug}', 'ListeController@liste')->name('liste');

Route::get('/', 'PagesController@index')->name('home');
Route::get('/rastgele', function(){
    $random = Movie::inRandomOrder()->first();
    return redirect( $random->url() );
});

Route::get('/izle/{id}-{slug}', 'PagesController@izle')->name('izle');
// Bazı filmlerde isim çince falan olunca slug olmuyor.
Route::get('/izle/{id}-', 'PagesController@izle')->name('izle');

Route::get('/kategoriler', 'PagesController@kategoriler')->name('kategoriler');
Route::get('/kategori/{slug}', 'PagesController@kategori')->name('kategori');

Route::get('/arsiv', 'PagesController@arsiv');

Route::get('/add-movie-from-tmdb/{tmdb_id}', 'MovieController@addMovieFromTmDB');
Route::get('/add-up-comings', 'MovieController@addUpComings');

Route::get('/auth/giris', 'PagesController@giris')->name('giris');
Route::post('/auth/giris', 'PagesController@giris_post')->name('giris_post');

Route::get('/auth/kayit', 'PagesController@kayit')->name('kayit');
Route::post('/auth/kayit', 'PagesController@kayit_post')->name('kayit_post');

Route::get('/auth/profil', 'PagesController@profil')->name('profil');
Route::get('/profil/{slug}', 'PagesController@profil_public')->name('profil_public');
