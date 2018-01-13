@extends("layouts.app")

@section("title", $q . " arama sonuçları")

@section("content")

    <div id="kategoriler" style="margin-top:20px;" class="arama_sonuclari">
        <div class="center">
            <div class="row">
                <div class="col col-md-5">
                    <h1 class="renkli"><span><div class="orange">{{ $q }} </div> İçeren Filmler ({{ count($filmler) }})</span></h1>
                    <ul class="kat_films">
                        @foreach($filmler as $film)
                            <li>
                                <a href="{{  $film->url() }}">
                                    <img src="{{ $film->mini_bg() }}" alt="">
                                    <div class="name">{{ $film->name }} ({{ $film->puan }})</div>
                                </a>
                            </li>
                        @endforeach

                        <div class="clear"></div>
                    </ul>
                </div>
                <div class="col pull-right col-md-5">
                    <h1 class="renkli"><span><div class="orange">{{ $q }} </div> İçeren Oyuncular ({{ count($oyuncular) }})</span></h1>

                    <div class="oyuncular">
                        <ul>
                            @foreach($oyuncular as $actor)
                                <li>
                                    <a href="{{ $actor->url() }}">
                                        <div class="img">
                                            <img src="{{ $actor->photo2() }}" alt="">
                                        </div>
                                        <div class="name">{{ $actor->name }}</div>
                                    </a>
                                </li>
                            @endforeach
                            <div class="clear"></div>
                        </ul>
                    </div>
                </div>
            </div>
            

           
        </div>
    </div>

@endsection