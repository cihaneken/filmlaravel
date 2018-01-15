<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mesaj;

class MesajController extends Controller
{

    public function getMesaj(Request $req)
    {
        $mesaj = Mesaj::find($req->id);

        return $mesaj;
    }

    public function delete(Request $req)
    {
        $mesaj = Mesaj::find($req->id);

        $data = [];

        if (!$mesaj){
            $data['mesaj'] = "Mesaj bulunamadı. Zaten silinmiş olabilir.";
            return $data;
        }

        if ($mesaj->delete())
        {
            $data['mesaj'] = "Mesaj silindi.";
            return $data;
        }else {
            $data['mesaj'] = "Hata.";
            return $data;
        }
    }
    public function create(Request $req)
    {
        
        $data = [];

        $kontrol = Mesaj::where("ip", $req->ip())->orderBy('id', 'desc')->first();

        if ($kontrol){
            if (time() < strtotime($kontrol->created_at) + (60 * 10)){
                $data['error'] = "Yeniden mesaj göndermek için 10dk beklemelisiniz.";
                return view("iletisim", $data);
            }
        }

        $mesaj = new Mesaj;
        $mesaj->ip = $req->ip();
        $mesaj->konu = $req->konu;
        $mesaj->isim = $req->isim;
        $mesaj->mesaj = $req->mesaj;
        $mesaj->mail = $req->mail;

        if ($mesaj->save()){
             $data['success'] = "Mesajınız iletildi. Gerektiği takdirde mail adresinize dönüş yapılacaktır.";
            return view("iletisim", $data);
        }else{
            $data['error'] = "Daha sonra tekrar deneyiniz.";
            return view("iletisim", $data);
        }
    }
}
