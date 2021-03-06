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
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckAdmin;

// Bot

Route::get('/bot', 'BotController@index');

// LISTELER
Route::get('/iletisim', 'PagesController@iletisim')->name('iletisim');
Route::post('/iletisim', 'MesajController@create')->name('iletisim');
Route::get('/listeler', 'ListeController@listeler')->name('listeler');
Route::get('/liste/olustur', 'ListeController@liste_olustur')->name('liste-olustur');
Route::post('/liste/olustur', 'ListeController@liste_olustur_post')->name('liste-olustur-post');
Route::get('/liste/{id}-{slug}', 'ListeController@liste')->name('liste');

Route::get('/', 'PagesController@index')->name('home');
Route::get('/rastgele', function(){
    $random = Movie::inRandomOrder()->first();
    return redirect( $random->url() );
});

Route::post('/filmi-getir', "MovieController@getir");

Route::get('/izle/{id}-{slug}', 'PagesController@izle')->name('izle');
// Bazı filmlerde isim çince falan olunca slug olmuyor.
Route::get('/izle/{id}-', 'PagesController@izle')->name('izle');

Route::get('/kategoriler', 'PagesController@kategoriler')->name('kategoriler');
Route::get('/kategori/{slug}', 'PagesController@kategori')->name('kategori');

Route::get('/oyuncu/{id}-{slug}', 'ActorController@filmler')->name('oyuncu');

Route::get('/arsiv', 'PagesController@arsiv');



Route::get('/auth/giris', 'PagesController@giris')->name('giris');
Route::post('/auth/update', 'PagesController@update_user')->name('update_user');
Route::get('/auth/cikis', function (){
    Auth::logout();
    return redirect("auth/giris");
});
Route::post('/auth/giris', 'PagesController@giris_post')->name('giris_post');

Route::get('/auth/kayit', 'PagesController@kayit')->name('kayit');
Route::post('/auth/kayit', 'PagesController@kayit_post')->name('kayit_post');

Route::get('/auth/profil', 'PagesController@profil')->name('profil');
Route::get('/profil/{slug}', 'PagesController@profil_public')->name('profil_public');

Route::get('/ara', 'PagesController@ara')->name('ara');


Route::post('/yorum-yap', 'CommentController@yorum_yap');
Route::post('/izlendi', 'MovieController@izlendi');

Route::get("/get-videos/{id}", 'MovieController@get_videos');

Route::get('/add-movie-from-tmdb/{tmdb_id}', 'MovieController@addMovieFromTmDB');

Route::group(['prefix' => 'admin',  'middleware' => CheckAdmin::class], function()
{
    Route::get('/', 'AdminController@index');

    Route::get('/kullanicilar', 'AdminController@kullanicilar');
    Route::get('/mesajlar', 'AdminController@mesajlar');
    Route::get('/admin-toggle/{id}', 'AdminController@admin_toggle');
    Route::get('/admin-sil/{id}', 'AdminController@admin_sil');

    Route::get('/videolar', 'AdminController@videolar');
    Route::get('/video-ekle', 'AdminController@video_ekle');
    Route::post('/video-ekle', 'VideoController@video_ekle');
    Route::get('/video-edit/{id}', 'VideoController@video_edit');
    Route::post('/video-edit', 'VideoController@video_edit_post');
    Route::post('/video-sil', 'VideoController@delete');
    Route::post('/mesaj-sil', 'MesajController@delete');
    Route::post('/get-mesaj', 'MesajController@getMesaj');

    Route::get('/yorumlar', 'AdminController@yorumlar');
    Route::get('/yorum-onayla/{comment}', 'AdminController@yorum_onayla');
    Route::get('/yorum-sil/{comment}', 'AdminController@yorum_sil');

    Route::get('/film-ekle', 'AdminController@film_ekle');
    Route::get('/film-edit', 'AdminController@film_edit');
    Route::post('/film-edit', 'MovieController@film_edit');
    Route::post('/film-getir', 'MovieController@getFilm');
    Route::post('/film-sil', 'MovieController@delete');

    Route::get('/add-movie-from-tmdb/{tmdb_id}', 'MovieController@addMovieFromTmDB');
    Route::get('/add-up-comings', 'MovieController@addUpComings');
});