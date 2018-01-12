<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Category;

class Movie extends Model
{   
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
