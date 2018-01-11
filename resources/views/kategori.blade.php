@extends("layouts.app")

@section("title", $kategori->name . " kategorisindeki filmler")

@section("content")

    <div id="kategoriler">
        <div class="center">
            <h1 class="renkli"><span> <div class="orange">{{ mb_strtoupper($kategori->name, "UTF-8") }} </div> KATEGORİSİNDEKİ FİMLER ({{ $kategori->filmSayisi() }})</span></h1>

            <ul>
                @foreach($filmler as $film)
                    <li>
                        <a href="{{  $film->url() }}">
                            <img src="{{ $film->mini_bg() }}" alt="">
                            <div class="name">{{ $film->name }} ({{ $film->puan }})</div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection