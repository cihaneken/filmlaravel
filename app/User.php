<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Movie;

class User extends Authenticatable
{
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function izledi($movie_id)
    {
        $kontrol = DB::table('izlemeler')->where('user_id', $this->id)->where('movie_id', $movie_id)->first();
        if ($kontrol)
            return true;

        return DB::table('izlemeler')->insert([
            'movie_id' => $movie_id,
            'user_id' => $this->id
        ]);
    }

    public function izlemeler()
    {
        return DB::table('izlemeler')->orderBy('id', 'DESC')->where('user_id', $this->id)->get();
    }

    public function sonIzlenen()
    {
        if (!count($this->izlemeler()))
            return false;
        else {
            return Movie::find( $this->izlemeler()[0]->movie_id );
        }
    }
}
