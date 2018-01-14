<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Video;

class VideoController extends Controller
{
    public function video_ekle(Request $req)
    {
     
        $data = [];
        if (!$req->kaynak || !$req->part1)
        {
            $data['mesaj'] = "Lütfen part 1 ve kaynak kısımlarını doldur.";
            return $data;
        }

        if (Video::where('part1', $req->part1)->first())
        {
            $data['mesaj'] = "Bu kaynak zaten ekli.";
            return $data;
        }

        try {
            $video = new Video;
            $video->movie_id = $req->id;
            $video->kaynak = $req->kaynak;
            $video->dil = $req->dil;
            $video->part1 = $req->part1;
            $video->part2 = $req->part2;
            $video->part3 = $req->part3;
            $video->part4 = $req->part4;
            $video->part5 = $req->part5;
            $video->part6 = $req->part6;
            $video->save();

            $data['mesaj'] = "Video Eklendi!";
            return $data;
        } Catch (Exception $e) {
            $data['mesaj'] = $e;
            return $data;
        }
        
    }
}
