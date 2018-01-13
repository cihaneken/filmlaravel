<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Movie;
use App\Cateogry;

class Category extends Model
{

    public function filmSayisi()
    {
        return DB::table('category_connector')->where('category_id', $this->id)->count();
    }

    public function film()
    {
        if (!$this->filmSayisi())
            return Movie::inRandomOrder()->first();

        $id = DB::table('category_connector')->inRandomOrder()->where('category_id', $this->id)->first()->movie_id;
        return Movie::find( $id );
    }
}
