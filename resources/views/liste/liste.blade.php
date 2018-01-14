@extends("layouts.app")

@section("title", $liste->name)

@section("content")

<div id="liste">
    <div class="center">
        <div class="head">
            <div class="left">
                <div class="name"><i class="fa fa-tv"></i> {{ $liste->name }}</div>
                <div class="puan">Ortalama puan: <span>{{ $liste->ortalama_puan }}</span></div>
            </div>

            <div class="right">
                <a href="{{ url('profil/' . $liste->user()->slug) }}">
                    <img src="{{ $liste->user()->avatar }}" alt="{{ $liste->user()->username }} avatar">
                    <div class="name">{{ $liste->user()->username }}</div>
                </a>
            </div>

            <div class="clear"></div>
        </div>

        <div class="filmler">
            @foreach( $liste->filmler() as $film )
            
            <div class="film">            
                <img src="{{ $film->backdrop_orj() }}" width="100%" alt="">
                <div class="bilgi">
                    <div class="left">
                        <a href="{{ $film->url() }}">
                            <img src="{{ $film->mini_poster() }}" alt="">
                        </a>
                    </div>

                    <div class="right">
                        <a href="{{ $film->url() }}">
                            <div class="name">{{ $film->name }} <span class="puan">{{ number_format($film->puan, 1, "." ,".") }}</span></div>
                        </a>
                        <div class="kategoriler">
                            @foreach($film->categories() as $category)
                                <a href="{{ url('kategori/' . $category->slug) }}">{{ $category->name }}</a>
                            @endforeach
                        </div>
                        <div class="konu">
                            {{ mb_substr($film->overview,0,300).".." }}
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            
            @endforeach
        </div>
    </div>
</div>

@endsection