<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Movie;
use App\Video;
use App\Mesaj;
use App\Liste;
use App\Comment;
use App\Actor;

class AdminController extends Controller
{
    public function index()
    {
        $filmler = Movie::all();
        $izlemeler = 0;
        foreach ($filmler as $film) {
            $izlemeler += $film->seen;
        }

        $data = [
            'uyeler' => count(User::all()),
            'yorumlar' => count(Comment::all()),
            'gosterim' => $izlemeler,
            'listeler' => count(Liste::all()),
            'oyuncular' => count(Actor::all()),
        ];
        return view("admin.index", $data);
    }

    public function film_ekle()
    {
        return view("admin.film_ekle");
    }

    public function kullanicilar()
    {
        $data = [];
        $data['kullanicilar'] = User::orderBy('username', 'asc')->get();
        return view("admin.kullanicilar", $data);
    }

    public function admin_toggle($id)
    {
        $data = [];
        $user = User::find($id);

        $user->is_admin = $user->is_admin == 1 ? 0:1;

        if ($user->save()){
            $data['mesaj'] = $user->is_admin ? 'Kullanıcı admin yapıldı.' : 'Kullanıcının adminliği kaldırıldı.';
        }else{
            $data['mesaj'] = "Veritabanı hatası.";
        }
        return $data;
    }
    public function admin_sil($id)
    {
        $data = [];
        $user = User::find($id);
        if (!$user){
            $data['mesaj'] = "Kullanıcı zaten silindi!";
            return $data;
        }
        

        if ($user->delete()){
            $data['mesaj'] = "Kullanıcı silinidi.";
        }else{
            $data['mesaj'] = "Veritabanı hatası.";
        }
        return $data;
    }

    public function video_ekle()
    {
        $data = [];
        $data['filmler'] = Movie::select('id', 'name')->orderBy('name', 'asc')->get();
        return view("admin.video_ekle", $data);
    }

    public function videolar()
    {
        $data = [];
        $data['filmler'] = Movie::select('id', 'name')->orderBy('name', 'asc')->get();
        return view("admin.videolar", $data);
    }

    public function mesajlar()
    {
        $data = [
            'mesajlar' => Mesaj::all()
        ];

        return view("admin.mesajlar", $data);
    }

    public function film_edit()
    {
        $data = [];
        $data['filmler'] = Movie::select('id', 'name')->orderBy('name', 'asc')->get();
        return view("admin.film_edit", $data); 
    }
}
