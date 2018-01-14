<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function yorum_yap(Request $req)
    {  
        $u =  (Session::get('u'));

        $cacheName = "yorum-cache-$u";
        $data = [
            'status' => 'error'
        ];
        if (! Cache::has( $cacheName ) ){
            $mesaj = $req->mesaj;
            $id = $req->movie_id;

            if (strlen($mesaj) < 10){
                $data['mesaj'] = "Yorum en az 10 karakterden oluşmalı.";
                return $data;
            }

            $movie = Movie::find( $id );
            if (!$movie){
                $data['mesaj'] = "Bir hata oluştu! Yorum yapmak için lütfen sayfayı yenileyin.";
                return $data;
            }

            $comment = new Comment;

            if (Auth::check())
                $comment->user_id = Auth::user()->id;

            $comment->movie_id = $id;
            $comment->body = $mesaj;

            if ($comment->save()){
                $data['status'] = "success";
                $data['mesaj'] = "Yorum yapıldı. Teşekkür ederiz.";

                Cache::put($cacheName, $mesaj, 5);

                $movie->comments++;
                $movie->save();

                return $data;
            }else{
                $data['mesaj'] = "Yorum yapılamadı. Lütfen daha sonra tekrar deneyiniz.";
                return $data;
            }

        }else {
            $data['mesaj'] = "5 dk da bir yorum yapabilirsiniz.";
            return $data;
        }
    }
}
