@extends("layouts.app")

@section("title", "Tüm Film Kategorileri")

@section("content")

    <div id="kategoriler">
        <div class="center">
            <h1 class="renkli"> <span>KATEGORİLER</span> </h1>
            <ul class="kat_films">
                @foreach($kategoriler as $kategori)
                    <li>
                        <a href="{{ url('kategori/' . $kategori->slug) }}">
                            <img src="{{ $kategori->film()->mini_bg() }}" alt="">
                            <div class="name"> {{ $kategori->name }} ({{ $kategori->filmSayisi() }})</div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection