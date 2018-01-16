<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Movie;
use App\Category;
use App\Country;
use App\Actor;
use App\Video;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function film_edit(Request $req)
    {
        $data = [];

        $film = Movie::find($req->id);

        $film->name = $req->name;
        $film->overview = $req->overview;
        $film->imdb_id = $req->imdb_id;
        $film->puan = $req->puan;
        $film->backdrop_url = $req->backdrop_url;
        $film->poster_url = $req->poster_url;
        $film->orj_name = $req->orj_name;
        $film->slug = str_slug($req->name, "-");
        
        if (!$film->save()){
            $data['error'] = "Bir hata oluştu.";
            return view("admin.film_edit", $data); 
        }
        
        $data['filmler'] = Movie::select('id', 'name')->orderBy('name', 'asc')->get();

        $data['success'] = $film->name . " güncellendi";
        return view("admin.film_edit", $data); 
        
        
    }
    public function getFilm(Request $req)
    {
        return Movie::find($req->id);
    }
    public function delete(Request $req)
    {
        $m = Movie::find($req->id);

        if (!$m){
            $data = ['mesaj' => "Film bulunamadı"];
            return $data;
        }

        if ($m->delete()){
            DB::table('actor_connector')->where('movie_id', $m->id)->delete();
            DB::table('category_connector')->where('movie_id', $m->id)->delete();
            $data = ['mesaj' => "Film silindi"];
            return $data;
        }else{
            $data = ['mesaj' => "Film silinirken hata oluştu."];
            return $data;
        }

    }
    public function get_videos($id)
    {
        return Video::where('movie_id', $id)->get();
    }
    public function addMovieFromTmDB( $tmdb_id )
    {
        $data = [
            'status' => 'error'
        ];
        $kontrol = Movie::where('tmdb_id', $tmdb_id)->first();

        if ($kontrol)
        {
            $data['mesaj'] = $kontrol->name . " zaten ekli. ";
            return $data;
        }

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

        // oyuncular
        
        $url = "https://api.themoviedb.org/3/movie/".$tmdb_id."/credits?api_key=" . env("TMDB_API_KEY");
        $req = $client->get($url);
        $res = $req->getBody();

        $oyuncular = json_decode($res);

        foreach ($oyuncular->cast as $oyuncu) {
            
            $actor = Actor::where('tmdb_id', $oyuncu->id)->first();
            if (!$actor){
                $actor = new Actor;
                $actor->tmdb_id = $oyuncu->id;
                $actor->gender = $oyuncu->gender;
                $actor->name = $oyuncu->name;
                $actor->slug = str_slug($oyuncu->name, "-");
                $actor->profile_path = $oyuncu->profile_path;
                $actor->save();
            }

            DB::table('actor_connector')->insert([
                'actor_id' => $actor->id,
                'movie_id' => $movie->id,
                'character' => $oyuncu->character,
                'order' => $oyuncu->order
            ]);

        }

        
        $data = [];
        
        $data['status'] = "success";
        $data['mesaj'] = $movie->name . " başarıyla eklendi. ";
        $data['movie'] = $movie;
        return $data;
        
    }

    public function addUpComings()
    {
        $client = new \GuzzleHttp\Client();
        $pages = 3;
        $current = 1;

        while ($current < $pages) {
            $req = $client->get("https://api.themoviedb.org/3/movie/top_rated?api_key=".env('TMDB_API_KEY')."&language=tr-TR&page=" . $current); 
            $res = json_decode($req->getBody());
            
            foreach ($res->results as $mov) {
                $this->addMovieFromTmDB($mov->id);
            }
            $current++;
        }

        echo "hepsi eklendi";
    }

    public function izlendi(Request $req)
    {
        $film = Movie::find($req->id);
        if (! $film)
            abort(404);
        
        $film->seen++;
        $film->save();

        if (Auth::check())
            Auth::user()->izledi($film->id);

        return "true";
    }

    public function getir(Request $req)
    {
        return Movie::find($req->id);
    }
}
