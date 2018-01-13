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
            <h1 class="renkli"><span>SONUÇLAR ({{ ($filmler->total()) }})</span></h1>

            <ul class="sonuclar_ul">
                @foreach($filmler as $film)
                <li class="sonuclar_li">
                    <a href="{{ $film->url() }}">
                        <img src="{{ $film->mini_bg() }}" alt="">
                        <div class="info">
                            <div class="name">{{ $film->name(35) }} <span>{{ $film->puan }}</span></div>
                            <div class="sene">
                                {{ $film->year }} | 
                                @foreach($film->categories() as $kat)
                                    <span>{{ $kat->name }}</span>
                                @endforeach
                            </div>
                            <div class="actors">
                                <ul>
                                    @foreach($film->actors(5) as $actor)
                                    <li>
                                        <img title="{{ $actor->name }}" src="{{ $actor->photo() }}" alt="">
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </a>
                </li>
                @endforeach
                <div class="clear"></div>
                @if (!count($filmler))
                    Hiç film bulunamadı. Filtre değiştirmeyi deneyin.
                    <br><br>
                    <a href="{{url('/arsiv')}}"> Tercihleri Sıfırlamak İçin Tıklayınız</a>
                @endif
            </ul>

            @if ($filmler->lastPage() > 1)
            <div class="sayfalama">
                <ul>
                    @for($i = 1; $i <= $filmler->lastPage(); $i++)
                    <li><a href="{{ '?kats=' . $_kats . '&sirala=' . $sirala . '&page='. $i }}" class="{{ $i == $filmler->currentPage() ? 'aktif' : null }}">{{ $i }}</a></li>
                    @endfor

                    <div class="clear"></div>
                </ul>
            </div>
            @endif
        </div>
        <div class="clear"></div>
    </div>
</div>

@endsection