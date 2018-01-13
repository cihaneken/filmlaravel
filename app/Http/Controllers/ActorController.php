<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actor;

class ActorController extends Controller
{
    public function filmler($id, $slug)
    {
        $actor = Actor::find($id);

        if (!$actor)
            abort(404);
        
        $data = [
            'actor' => $actor
        ];

        return view("oyuncu", $data);
    }
}
