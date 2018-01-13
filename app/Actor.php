<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Movie;

class Actor extends Model
{
    public function url()
    {
        return url('oyuncu/' . $this->id ."-". $this->slug);
    }
    public function filmler()
    {
        $filmler = DB::table("actor_connector")->where('actor_id', $this->id)->get();
        $rtn = [];
        foreach ($filmler as $film) {
            $rtn[] = Movie::find( $film->movie_id );
        }

        return $rtn;
    }

    public function photo()
    {
        return "https://image.tmdb.org/t/p/w45" . $this->profile_path;
    }
    
    public function photo2()
    {
        return "https://image.tmdb.org/t/p/w185" . $this->profile_path;
    }
}
