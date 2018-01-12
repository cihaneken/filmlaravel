<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Movie;
use App\User;

class Liste extends Model
{
    protected $table = "lists";

    public function user()
    {
        return User::find($this->user_id);
    }

    public function filmler($limit = false)
    {
        $idler = unserialize($this->movies);
        
        $filmler = [];
        $i = 0;
        foreach ($idler as $id) {
            $filmler[] = Movie::find($id);
            $i++;
            if ($limit && $limit == $i) break;
        }

        return $filmler;
    }
}
