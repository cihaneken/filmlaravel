@extends("layouts.app")

@section("title", "Listeler")

@section("content")
<div id="listeler">
    <div class="center">
        <h1 class="renkli">
            <span>LİSTELER</span>
            <a href="#"><i class="fa fa-plus"></i> Listeni oluştur!</a>
        </h1>

        <div class="slogan">
            <i class="fa fa-tv fa-3x"></i> <br><br>
            Listelere hoşgeldiniz! <br>Artık sevdiğiniz türden filmleri, sizler gibi film severler tarafından oluşturulan listeler içinde bulabilirsiniz!
        </div>

        @foreach($listeler as $liste)
        <div class="liste_vitrin">

            <div class="bg" style="background:url({{$liste->filmler()[array_rand($liste->filmler())]->backdrop_orj() }})">&nbsp;</div>
           
            <br>
            
            <div class="left">
                <a href="{{ url('liste/' . $liste->id . "-" . str_slug($liste->name, "-")) }}">
                    <div class="baslik">
                        {{ $liste->name }}
                    </div>

                    <div class="puan">
                        Ortalama Puan: <span>{{ $liste->ortalama_puan }}</span>
                    </div>
                </a>
            </div>

            <div class="right">
                <a href="{{ url('profil/' . $liste->user()->slug) }}">
                    <img src="{{ $liste->user()->avatar }}" alt="">
                    <span>{{ $liste->user()->username }}</span>
                </a>
            </div>
            <div class="clear"></div>
            
            <ul class="filmler">
                @foreach($liste->filmler(5) as $movie)
                <li>
                    <div class="film-afis">
                        <a href="{{ $movie->url() }}" title="{{ $movie->name }}">
                            <img src="{{ $movie->poster_url }}" alt="{{ $movie->name }} poster">
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
                <div class="clear"></div>
            </ul>

            <div class="kesfet">
                <a href="{{ url('liste/' . $liste->id . "-" . str_slug($liste->name, "-")) }}">Listeyi Keşfet</a>
            </div>
            <br>
            <div class="clear"></div>
        </div>
        @endforeach
    </div>
</div>
@endsection
