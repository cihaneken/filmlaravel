<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Movie;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    
    public function arsiv()
    {
        $data = [];
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

        $data['filmler'] = $filmler->get();

        $data['sirala'] = $sirala;
        

        return view("arsiv", $data);
    }
    public function index()
    {
        $data = [];
        $data['slider'] = Movie::where("puan", ">", 6)->inRandomOrder()->limit(10)->get();
        $data['categories'] = Category::orderBy('name', "ASC")->get();
        $data['movies'] = Movie::orderBy('id', 'DESC')->limit(36)->get();
        return view('home', $data);
    }

    public function izle($id, $slug = false)
    {
        $movie = Movie::find($id);
        $movie->seen++;
        $movie->save();
        if (!$movie)
            abort(404);

        $data = [];

        $data['movie'] = $movie;

        return view("izle", $data);
    }

    public function kategoriler()
    {
        $data = [];

        $data['kategoriler'] = Category::orderBy('name', 'ASC')->get();

        return view("kategoriler", $data);
    }

    public function kategori($kategori, $sirala = "puan")
    {
        $data = [];

        $kategori = Category::where('slug', $kategori)->first();

        $siralaType = "DESC";

        $filmler = DB::table('category_connector')->where('category_id', $kategori->id)->get();

        $tmp = [];

        foreach ($filmler as $film) {
            $tmp[] = Movie::find($film->movie_id);
        }

        $data['kategori'] = $kategori;
        $data['filmler'] = $tmp;

        return view("kategori", $data);
    }
}
