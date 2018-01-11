@extends("layouts.app")

@section("title", $movie->name . " izle")

@section("content")

<div id="izle">
    <div class="izle-bg" style="background-image: url({{ $movie->backdrop_orj() }});">&nbsp;</div>
    <div class="izle-film">
            <div id="player">
                <div class="center">
                    <div class="top">
                        <div class="select">
                            Dil: İngilizce <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="select">
                            Kaynak: Fragman <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="select">
                            Part: 1 <i class="fa fa-angle-down"></i>
                        </div>

                        <div class="clear"></div>
                    </div>

                    <div class="player">
                        <iframe width="100%" height="500" src="https://www.youtube.com/embed/TyHvyGVs42U" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="info">
                    <div class="center">
                        <div class="left">
                            <img src="{{ $movie->poster_url }}" alt="">
                        </div>
                        <div class="right">
                            <div class="name">
                                <h1>{{ $movie->name }}</h1>
                                <ul>
                                    <li>Orjinal: <span>{{ $movie->orj_name }}</span></li>
                                    <li>Yapım Yılı: <span>{{ $movie->year }}</span></li>
                                    <li>Süre: <span>{{ $movie->duration ? $movie->duration : "Bilinmiyor" }}</span></li>
                                    <li>Puan: <span>{{ $movie->puan }}</span></li>
                                    <div class="clear"></div>
                                </ul>
                                <div class="clear"></div>
                            </div>

                            <div class="kats">
                                <ul>
                                    @foreach($movie->categories() as $category)
                                        <li><a href="{{ url('kategori/' . $category->slug) }}">{{ $category->name }}</a></li>
                                    @endforeach
                                    <div class="clear"></div>
                                </ul>
                            </div>

                            <div class="konu">
                                <h3>Filmin konusu</h3>
                                <p>
                                    @if ($movie->overview)
                                        {{ $movie->overview }}
                                    @else
                                        <strong>{{ $movie->name }}</strong> filmine henüz bir konu eklenmemiş. 
                                        <br> Film hakkında bir kısa özet yazıp bize göndermeye ne dersiniz?
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
        </div>
    </div>
</div>

@endsection