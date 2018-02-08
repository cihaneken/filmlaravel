<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BotController extends Controller
{
    public function index(){
        $client = new \GuzzleHttp\Client();

        $url = "https://filmakinesi.org/page/";

        for($i = 1; $i <= 270; $i++){


            $req = $client->get($url . $i);

            $html = $req->getBody();

            preg_match_all('<a href="(.*?)-izle-(.*?).html" rel="bookmark" title="(.*?) izle">', $html, $res);

            return $res;
            
            break;
        }


    }
}
