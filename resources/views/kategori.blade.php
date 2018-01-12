@extends("layouts.app")

@section("title", $kategori->name . " kategorisindeki filmler")

@section("content")

    <div id="kategoriler">
        <div class="center">
            <h1 class="renkli">
                <span> 
                    <div class="orange">{{ mb_strtoupper($kategori->name, "UTF-8") }} </div> 
                    KATEGORİSİNDEKİ FİMLER ({{ $filmler->total() }})
                    <div class="orange" style="color:#777;">{{ $filmler->currentPage() }}. Sayfa</div>
                </span>
            </h1>

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

            <div class="sayfalama">
                <ul>
                    @for($i = 1; $i <= $filmler->lastPage(); $i++)
                    <li><a href="{{ '?page='. $i }}" class="{{ $i == $filmler->currentPage() ? 'aktif' : null }}">{{ $i }}</a></li>
                    @endfor

                    <div class="clear"></div>
                </ul>
            </div>
        </div>
    </div>

@endsection