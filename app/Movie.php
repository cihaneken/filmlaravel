<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Comment;
use App\Actor;

class Movie extends Model
{   
    public function actors($limit = 99)
    {
        $actors = [];
        $_list = DB::table('actor_connector')->where('movie_id', $this->id)->orderBy('order', 'asc')->limit($limit)->get();

        foreach ($_list as $e)
        {   
            $actor = Actor::find($e->actor_id);  
            $actor->character = $e->character;
            if ($actor->profile_path)
                $actors[] = $actor;    
        }

        return $actors;
    }

    public function stars()
    {
        $max = 5;
        $puan = $this->puan;

        if ($puan > 8.1) $puan = 10;
        if ($puan >= 7.8 && $puan <= 8) $puan = 8;
        if ($puan >= 6.8 && $puan <= 7) $puan = 7;

        $stars = ceil(($max * floor($puan / 2)) / 5);
        for($i = 1; $i <= $max; $i++){
            if ($i <= $stars)
                echo '<i class="fa fa-star light"></i>';
            else
                echo '<i class="fa fa-star"></i>';
        }
    }
    public function comments()
    {
        return Comment::where('movie_id', $this->id)->where('is_checked', 1)->orderBy('id', 'desc')->get();
    }
    public function name($limit)
    {
        if (strlen($this->name) < $limit)
            return $this->name;
        else {
            return mb_substr($this->name, 0, $limit-2, "utf-8") ."..";
        }
    }

    public function url()
    {
        return url("izle", $this->id . "-" . ($this->slug ? $this->slug : str_slug($this->orj_name, "-")));
    }

    public function backdrop_orj()
    {
        return str_replace("w780", "w1280", $this->backdrop_url);
    }

    public function mini_bg()
    {
        return str_replace("w780", "w780", $this->backdrop_url);
    }

    public function mini_poster()
    {
        return str_replace("w1280", "w500", $this->poster_url);
    }
    

    public function categories()
    {
        $baglantilar = DB::table('category_connector')->where('movie_id', $this->id)->get();

        $kategoriler = [];

        foreach ($baglantilar as $baglanti)
            $kategoriler[] = Category::find( $baglanti->category_id );
        
        return $kategoriler;
    }
}
