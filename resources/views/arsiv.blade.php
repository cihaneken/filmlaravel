@extends("layouts.app")

@section("title", "Film Arşivi")

@section("content")

<div id="arsiv">
    <div class="center">
        <div class="left">
            <h1 class="renkli"><span>SIRALA</span></h1>
            <ul>
                <li><a href="{{ '?sirala=puan&kats='.$_kats }}"><i class="fa fa-trophy" style="color:orange"></i> PUANI</a></li>
                <li><a href="{{ '?sirala=seen&kats='.$_kats }}"><i class="fa fa-eye"  style="color:orangered"></i> İZLENME SAYISI</a></li>
                <li><a href="{{ '?sirala=comments&kats='.$_kats }}"><i class="fa fa-comments"  style="color:yellow"></i> YORUM SAYISI</a></li>
                <li><a href="{{ '?sirala=year&kats='.$_kats }}"><i class="fa fa-calendar"  style="color:lightgreen"></i> YAPIM YILI</a></li>
                <li><a href="{{ '?sirala=id&kats='.$_kats }}"><i class="fa fa-clock-o"  style="color:#fa3556"></i> EKLENME TARİHİ</a></li>
            </ul>

            <h1 class="renkli"><span>KATEGORİLER</span></h1>
            <div class="list">
                @foreach($kategoriler as $kategori)
                <a href="{{ '?sirala='.$sirala.'&kats=' . ($_kats . ',' . $kategori->slug) }}">
                    <i class="fa {{ $kategori->check ? 'fa-check-circle-o' : 'fa-circle-o' }}"></i> 
                    {{ $kategori->name }}
                </a>
                @endforeach
            </div>
        </div>

        <div class="sonuclar">
            <h1 class="renkli"><span>SONUÇLAR ({{ count($filmler) }})</span></h1>

            <ul>
                @foreach($filmler as $film)
                <li>
                    <a href="{{ $film->url() }}">
                        <img src="{{ $film->mini_bg() }}" alt="">
                        <div class="info">
                            <div class="name">{{ strlen($film->name) > 35 ? mb_substr($film->name, 0, 33, 'utf-8').".." : $film->name }} <span>{{ $film->puan }}</span></div>
                            <div class="sene">
                                {{ $film->year }} | 
                                @foreach($film->categories() as $kat)
                                    <span>{{ $kat->name }}</span>
                                @endforeach
                            </div>
                            <div class="konu">{{ mb_substr($film->overview,0,200,"utf-8").".."}}</div>
                        </div>
                    </a>
                </li>
                @endforeach

                @if (!count($filmler))
                    Hiç film bulunamadı. Filtre değiştirmeyi deneyin.
                    <br><br>
                    <a href="{{url('/arsiv')}}"> Tercihleri Sıfırlamak İçin Tıklayınız</a>
                @endif
            </ul>
        </div>
        <div class="clear"></div>
    </div>
</div>

@endsection