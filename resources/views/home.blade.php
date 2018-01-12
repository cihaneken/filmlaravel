@extends("layouts.app")

@section("content")
<div id="slider">
    <div class="center">
        
        <h1 class="renkli"> <span>ÖNERDİĞİMİZ FİLMLER</span> </h1>

        <div class="owl-carousel">
            @foreach($slider as $movie)
                <div class="film-afis">
                    <a href="{{ $movie->url() }}" title="{{ $movie->name }}">
                        <img src="{{ $movie->mini_poster() }}" alt="{{ $movie->name }} poster">
                        <div class="puan">{{ $movie->puan }}</div>
                        <div class="golge">&nbsp;</div>
                        <div class="info">
                            <div class="name">{{ $movie->name(19) }}</div>
                            <div class="stars">
                                <i class="fa fa-star light"></i>
                                <i class="fa fa-star light"></i>
                                <i class="fa fa-star light"></i>
                                <i class="fa fa-star light"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div id="homeView">
    <div class="center">
        <div class="left">
            <h1 class="renkli"> <span style="border-color:yellow">ENLER KATEGORİSİ</span> </h1>
            <ul>
                <li><a href="#"><i class="fa fa-clock-o"></i> Son Eklenenler</a></li>
                <li><a href="#"><i class="fa fa-star"></i> Bu Sıralar Popüler</a></li>
            </ul>

            <h1 class="renkli"> <span>FİLM KATEGORİLERİ</span> </h1>
            <ul class="kategoriler">
                @foreach($categories as $category)
                    <li><a href="{{ url('kategori/' . $category->slug) }}">{{ $category->name }} <span>({{ $category->filmSayisi() }})</span><i class="fa fa-angle-right"></i></a></li>
                @endforeach
            </ul>
        </div>
        <div class="filmler">
            <h1 class="renkli"> <span>SON EKLENENLER</span> </h1>

            <ul>
                @foreach($movies as $movie)
                <li>
                    <div class="film-afis">
                        <a href="{{ $movie->url() }}" title="{{ $movie->name }}">
                            <img src="{{ $movie->mini_poster() }}" alt="{{ $movie->name }} poster">
                            <div class="puan">{{ $movie->puan }}</div>
                            <div class="golge">&nbsp;</div>
                            <div class="info">
                                <div class="name">{{ $movie->name(19) }}</div>
                                <div class="stars">
                                    <i class="fa fa-star light"></i>
                                    <i class="fa fa-star light"></i>
                                    <i class="fa fa-star light"></i>
                                    <i class="fa fa-star light"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="clear"></div>
    </div>
</div>

@endsection