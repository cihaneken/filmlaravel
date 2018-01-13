<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Comment extends Model
{
    public function user()
    {
        if (!$this->user_id)
            return false;
            
        return User::find( $this->user_id );
    }
}
