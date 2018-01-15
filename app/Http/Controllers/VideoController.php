<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Video;

class VideoController extends Controller
{
    public function delete(Request $req)
    {
        $data = [];
        $video = Video::find($req->id);
        if (!$video)
        {
            $data['mesaj'] = "Video bulunamadı. Zaten silinmiş olabilir.";
            return $data;
        }

        if ($video->delete()){
            $data['mesaj'] = "Video silindi.";
            return $data;
        }else{
            $data['mesaj'] = "Video silinirken bir hata oluştu.";
            return $data;
        }

    }
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

    public function video_edit_post(Request $req)
    {
        
        $data = [];
        if (!$req->kaynak || !$req->part1)
        {
            $data['mesaj'] = "Lütfen part 1 ve kaynak kısımlarını doldur.";
            return $data;
        }

        try {
            $video = Video::find($req->vid);
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

            $data['mesaj'] = "Video Düzenlendi!";
            return redirect( url('admin/video-edit/'.$video->id) );
        } Catch (Exception $e) {
            $data['mesaj'] = $e;
            return $data;
        }
    }
    public function video_edit($id)
    {
        
        $data = [];
        $data['video'] = Video::find($id);
        $data['filmler'] = Movie::orderBy('name', 'asc')->get();

        return view("admin.video_edit", $data);
    }
}
