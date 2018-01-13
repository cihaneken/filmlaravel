@extends("layouts.app")

@section("title", $actor->name . " filmleri")

@if (count($actor->filmler()))
<div class="auth-bg" style="background:url({{ $actor->filmler()[0]->backdrop_orj() }});">
    &nbsp;
</div>
@endif

@section("content")

    <div id="kategoriler">
        <div class="center">
            <h1 class="renkli">
                <span> 
                    <div class="orange">{{ mb_strtoupper($actor->name, "UTF-8") }} </div> 
                    Filmleri ({{ count($actor->filmler()) }})
                </span>
            </h1>

            <ul class="kat_films">
                @foreach($actor->filmler() as $film)
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
    </div>

@endsection