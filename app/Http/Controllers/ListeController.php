<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Liste;
use App\Movie;
use Illuminate\Support\Facades\Auth;

class ListeController extends Controller
{
    public function liste_olustur_post(Request $req)
    {
        if (!Auth::check())
            return "Lütfen giriş yapınız.";
        
        $filmler = $req->filmler;
        $name = $req->name;
        
        $data = [
            'status' => "error",
        ];

        if (strlen($name) < 10)
        {
            $data['mesaj'] = "Liste adı en az 10 karakterden oluşmalı";
            return $data;
        }

        if (count($filmler) < 4)
        {
            $data['mesaj'] = "Listede en az 4 film olmalı";
            return $data;
        }

        $ids = [];
        $toplam = 0;
        foreach ($filmler as $film) {
            $toplam += $film['puan'];
            $ids[] = $film['id'];
        }
        

        $liste = new Liste;
        $liste->user_id = Auth::user()->id;
        $liste->name = $name;
        $liste->movies = serialize($ids);
        $liste->ortalama_puan = number_format(($toplam / count($ids)), 1, ".", ".");
        
        if (!$liste->save())
        {
            $data['mesaj'] = "Veritabanı hatası";
            return $data;
        }else{
            $data['status'] = "success";
            $data['mesaj'] = "Liste oluşturdu";
            $data['url'] = url('/liste/'. $liste->id . "-" . str_slug($liste->name, "-"));
            return $data;
        }
    }
    public function liste_olustur()
    {

        if (!Auth::check())
            return redirect( url('auth/giris') );
        
        $data = [];
        $data['filmler'] = Movie::select('id', 'name')->orderBy('name', 'ASC')->get();
        return view("liste.olustur", $data);
    }
    public function listeler()
    {
        $data = [];

        $data['listeler'] = Liste::all();

        return view("liste.listeler", $data);
    }

    public function liste($id, $slug)
    {
        $data = [];

        $data['liste'] = Liste::find( $id );

        return view("liste.liste", $data);
    }
}
