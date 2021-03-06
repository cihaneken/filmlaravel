<?php

namespace App\Http\Controllers;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Category;
use App\Movie;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Actor;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function update_user(Request $req)
    {
        $data = [];
        if (strlen($req->mail) < 3 || !$req->avatar){
            $data['mesaj'] = "Lütfen bir avatar url ve bir mail adresi yaazınız.";
            return $data;
        }

        $user = User::find( Auth::user()->id );
        $user->email = $req->mail;
        $user->avatar = $req->avatar;

        if ($req->sifre)
            $user->password = bcrypt($req->sifre);
        
        if ($user->save()){
            $data['mesaj'] = "Bilgileriniz güncellenmiştir.";
            return $data;
        }else{
            $data['mesaj'] = "Bir hata oluştu. Lütfen girdiğiniz bilgileri kontrol ediniz.";
            return $data;
        }
    }
    public function iletisim()
    {
        $data = [];
        $agent = new Agent();
        $page = "iletisim";
        if ($agent->isMobile() || $agent->isTablet())
            $page = "mobil.iletisim";

        return view($page, $data);
    }
    public function arsiv()
    {
        $page = @$_GET['page']  ? $_GET['page'] : 1;

        $data = [];

        $data['page'] = $page;

        $data['kategoriler'] = Category::orderBy('name', 'ASC')->get();
        
        $sirala = @$_GET['sirala'] ? $_GET['sirala'] : 'puan';

        $data['_kats'] = @$_GET['kats'] ? $_GET['kats'] : '';

        $_kats = explode(",", $data['_kats']);

        $same = (array_diff_key($_kats, array_unique($_kats)));

        foreach ($same as $key => $value) {
            $same = ($value);
        }
        
        if (count($same)){
        $data['_kats'] = "";
            foreach ($_kats as $__kat) {
                if ($__kat != $same)
                    $data['_kats'] .= "," . $__kat;
            }
            return redirect("/arsiv?kats=" . $data['_kats'] . "&sirala=" . $sirala);
        }

        foreach ($data['kategoriler'] as &$kat) {
            $kat->check = false;
            
            if ($_kats != ''){
                foreach ($_kats as $_kat) {
                    if($kat->slug == $_kat)
                        $kat->check = true;
                }
            }

        }

        $filmler = Movie::orderBy($sirala, "DESC");
        
        foreach ($_kats as $_kat) {
            $filmler = $filmler->where('categories', 'like', '%'.$_kat.'%');
        }

        $data['filmler'] = ($filmler->paginate(10));
        


        $data['sirala'] = $sirala;
        

        $agent = new Agent();
        $page = "arsiv";
        if ($agent->isMobile() || $agent->isTablet())
            $page = "mobil.arsiv";

        return view($page, $data);
    }
    public function index()
    {
        $data = [];
        $data['slider'] = Movie::where("puan", ">", 6)->inRandomOrder()->limit(10)->get();
        $data['categories'] = Category::orderBy('name', "ASC")->get();
        $data['movies'] = Movie::orderBy('id', 'DESC')->limit(36)->get();

        $agent = new Agent();
        $page = "home";
        if ($agent->isMobile() || $agent->isTablet())
            $page = "mobil.home";

        return view($page, $data);
    }

    public function izle($id, $slug = false)
    {
        $movie = Movie::find($id);
        if (!$movie)
            abort(404);

        /*
        $movie->seen++;
        $movie->save();

        if (Auth::check())
            Auth::user()->izledi($movie->id);
        */

        $data = [];

        $data['movie'] = $movie;

        $agent = new Agent();
        $page = "izle";
        if ($agent->isMobile() || $agent->isTablet())
            $page = "mobil.izle";
        return view($page, $data);
    }

    public function kategoriler()
    {
        $data = [];

        $data['kategoriler'] = Category::orderBy('name', 'ASC')->get();

        $agent = new Agent();
        $page = "kategoriler";
        if ($agent->isMobile() || $agent->isTablet())
            $page = "mobil.kategoriler";

        return view($page, $data);
    }

    public function kategori($kategori, $sirala = "puan")
    {
        $data = [];

        $kategori = Category::where('slug', $kategori)->first();

        $siralaType = "DESC";

        $filmler = Movie::where('categories', 'like', '%'.$kategori->slug.'%')->paginate(12);
        
        $data['kategori'] = $kategori;
        $data['filmler'] = $filmler;

        $agent = new Agent();
        $page = "kategori";
        if ($agent->isMobile() || $agent->isTablet())
            $page = "mobil.kategori";

        return view($page, $data);
    }

    public function giris()
    {
        $data = [];
        $data['film'] = Movie::inRandomOrder()->first();
        $agent = new Agent();
        $page = "auth.login";
        if ($agent->isMobile() || $agent->isTablet())
            $page = "mobil.giris";

        return view($page, $data);
    }

    public function giris_post(Request $req)
    {

        $remember = isset($req->remember) ? 'on' : null;

        if (Auth::attempt(['username' => $req->username, 'password' => $req->password], $remember)) {
            // Authentication passed...
            return redirect( url("/") );
        }else{
            $data = [];
            $data['film'] = Movie::inRandomOrder()->first();
            $data['error'] = "Bilgileriniz hatalı.";
            $agent = new Agent();
            $page = "auth.login";
            if ($agent->isMobile() || $agent->isTablet())
                $page = "mobil.giris";

            return view($page, $data);
        }
    }

    public function kayit()
    {
        $data = [];
        $data['film'] = Movie::inRandomOrder()->first();

        $agent = new Agent();
        $page = "auth.register";
        if ($agent->isMobile() || $agent->isTablet())
            $page = "mobil.kayit";

        return view($page, $data);
    }

    public function kayit_post(Request $req)
    {
        
        $data = [];
        $data['film'] = Movie::inRandomOrder()->first();

        $agent = new Agent();
        $page = "auth.register";
        if ($agent->isMobile() || $agent->isTablet())
            $page = "mobil.kayit";

       

        if (!$req->username || !$req->email || !$req->password)
            return view($page, ['error' => 'Lütfen boş alan bırakma.', 'film' => $data['film']]);
        
        if (strlen($req->username) < 4)
            return view($page, ['error' => 'Kullanıcı adı en az 4 karakter olmalı.', 'film' => $data['film']]);

        if (strlen($req->password) < 4)
            return view($page, ['error' => 'Şifre en az 4 karakter olmalı.', 'film' => $data['film']]);

        $kontrol = User::where('username', $req->username)->first();
        if ($kontrol)
            return view($page, ['error' => 'Bu kullanıcı adı sistemimizde mevcut.', 'film' => $data['film']]);

        $user = new User;
        $user->username = $req->username;
        $user->slug = str_slug($req->username, "-");
        $user->password = bcrypt($req->password);
        $user->email = $req->email;
        $user->avatar = env("DEFAULT_AVATAR");
        $user->name = "Kullanıcı";
        $user->is_admin = 0;

        if (!$user->save())
            return view($page, ['error' => 'Veritabanı hatası.']);
        
        if (Auth::attempt(['username' => $req->username, 'password' => $req->password])) {
            // Authentication passed...
            return redirect( url('/') );
        }
    }

    public function profil()
    {
        $data = [];
        $data['user'] = Auth::user();
        $agent = new Agent();
        $page = "auth.profil";
        if ($agent->isMobile() || $agent->isTablet())
            $page = "mobil.profil";
        return view($page, $data);
    }

    public function profil_public($slug)
    {
        $data = [];
        $data['user'] = User::where('slug', $slug)->first();
        $agent = new Agent();
        $page = "auth.profil";
        if ($agent->isMobile() || $agent->isTablet())
            $page = "mobil.profil";
        return view($page, $data);
    }

    public function ara()
    {
        $q = @ $_GET['q'];

        if (!$q || strlen($q) < 3) return redirect( url('/') );

        $filmler = Movie::where('name', 'like', "%$q%")->orWhere('orj_name', 'like', "%$q%")->get();
        $oyuncular = Actor::where('name', 'like', "%$q%")->where('profile_path', 'like', '%/%')->get();

        $data = [
            'filmler' => $filmler,
            'oyuncular' => $oyuncular,
            'q' => $q
        ];
        $agent = new Agent();
        $page = "ara";
        if ($agent->isMobile() || $agent->isTablet())
            $page = "mobil.ara";
        return view($page, $data);
    }
}
