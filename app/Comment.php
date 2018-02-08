<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Movie;

class Comment extends Model
{
    public function film()
    {
        return Movie::find($this->movie_id);
    }
    public function user()
    {
        if (!$this->user_id)
            return false;
            
        return User::find( $this->user_id );
    }
}
