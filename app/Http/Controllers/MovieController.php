<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Movie;
use App\Category;
use App\Country;

class MovieController extends Controller
{
    public function addMovieFromTmDB( $tmdb_id )
    {

        $kontrol = Movie::where('tmdb_id', $tmdb_id)->first();

        if ($kontrol)
            return "Zaten ekli";

        $client = new \GuzzleHttp\Client();

        $url = "https://api.themoviedb.org/3/movie/" . $tmdb_id . "?api_key=" .  env("TMDB_API_KEY") . "&language=tr-TR";

        $req = $client->get($url);

        $res = $req->getBody();

        $data = json_decode($res);



       

        $poster_url = "https://image.tmdb.org/t/p/w1280" . $data->poster_path;
        $backdrop_url = "https://image.tmdb.org/t/p/w780" . $data->backdrop_path;

        
        $movie = new Movie;

        $movie->imdb_id = $data->imdb_id;
        $movie->tmdb_id = $tmdb_id;
        $movie->name = $data->title;
        $movie->slug = str_slug($data->title, "-");
        $movie->puan = $data->vote_average;
        $movie->orj_name = $data->original_title;
        $movie->year = explode("-", $data->release_date)[0];
        $movie->poster_url = $poster_url;
        $movie->backdrop_url = $backdrop_url;
        $movie->categories = "a";
        if (isset($data->belongs_to_collection->id))
            $movie->belongs_to_collection = $data->belongs_to_collection->id;
        else
            $movie->belongs_to_collection = 0;
            
        $movie->overview = $data->overview;
        $movie->duration = $movie->runtime || 0;
        $movie->seen = 0;
        $movie->save();

        $kategoriler_text = "";
        foreach ($data->genres as $kategori) {
            $kontrol = Category::where("name", $kategori->name)->first();

            if (!$kontrol){
                $category = new Category;
                $category->name = $kategori->name;
                $category->slug = str_slug($kategori->name, "-");
                $category->save();
            }else {
                $category = $kontrol;
            }

            $kategoriler_text .= "@".$kategori->name."|".str_slug($kategori->name, "-")."@";

            DB::table("category_connector")->insert([
                'movie_id' => $movie->id,
                'category_id' => $category->id
            ]);
        }
        $movie->categories = $kategoriler_text;
        $movie->save();
        foreach ($data->production_countries as $ulke) {
            $kontrol = Country::where("name", $ulke->name)->first();

            if (!$kontrol){
                $country = new Country;
                $country->name = $ulke->name;
                $country->slug = str_slug($ulke->name, "-");
                $country->save();
            }else {
                $country = $kontrol;
            }

            DB::table("country_connector")->insert([
                'movie_id' => $movie->id,
                'country_id' => $country->id
            ]);
        }

        return $movie;
    }

    public function addUpComings()
    {
        $client = new \GuzzleHttp\Client();
        $pages = 10;
        $current = 1;

        while ($current < $pages) {
            $req = $client->get("https://api.themoviedb.org/3/movie/popular?api_key=".env('TMDB_API_KEY')."&language=tr-TR&page=" . $current); 
            $res = json_decode($req->getBody());
            

            foreach ($res->results as $mov) {
                $this->addMovieFromTmDB($mov->id);
            }
            $current++;
        }

        echo "hepsi eklendi";
    }
}
