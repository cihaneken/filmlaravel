<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Liste;

class ListeController extends Controller
{

    public function listeler()
    {
        $data = [];

        $data['listeler'] = Liste::all();

        return view("liste.listeler", $data);
    }

    public function liste($id, $slug)
    {
        $data = [];

        $data['liste'] = Liste::find( $id );

        return view("liste.liste", $data);
    }
}
