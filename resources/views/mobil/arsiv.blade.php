@extends("mobil.mobil")

@section('content')
<h5>
    <div class="row">
        <div class="col col-4">
            <i class="fa fa-archive" style="color:orange"></i> Arşiv ({{ $filmler->total() }})
        </div>
        <div class="col col-8 pull-right mx-right text-right">
            <div class="row">
                <div class="col col-6">
                    <button class="btn" style="margin:0" onclick="javascript:$('#sirala').slideToggle();$('#kategoriler').hide();"><i class="fa fa-bars"></i> Sırala</button>
                </div>
                <div class="col col-6">
                    <button class="btn" style="margin:0" onclick="javascript:$('#kategoriler').slideToggle();$('#sirala').hide();"><i class="fa fa-bars"></i> Kategoriler</button>
                </div>
            </div>
        </div>
    </div>
</h5>

<div class="showLater">
    <div id="sirala" class="arsiv_acilir">
        <ul class="list-group">
            <li class="list-group-item disabled">SIRALAMA ŞEKLİ</li>
            <li class="list-group-item"><a href="{{ '?sirala=puan&kats='.$_kats }}"><i class="fa fa-trophy"></i> Puan</a></li>
            <li class="list-group-item"><a href="{{ '?sirala=seen&kats='.$_kats }}"><i class="fa fa-eye"></i> İzlenme Sayısı</a></li>
            <li class="list-group-item"><a href="{{ '?sirala=comments&kats='.$_kats }}"><i class="fa fa-comments"></i> Yorum Sayısı</a></li>
            <li class="list-group-item"><a href="{{ '?sirala=year&kats='.$_kats }}"><i class="fa fa-calendar"></i> Yapım Yılı</a></li>
            <li class="list-group-item"><a href="{{ '?sirala=created_at&kats='.$_kats }}"><i class="fa fa-clock-o"></i> Eklenme Tarihi</a></li>
        </ul>
    </div>
    <div id="kategoriler" class="arsiv_acilir">
        <ul class="list-group">
            <li class="list-group-item disabled">KATEGORİLER</li>
            
            @foreach($kategoriler as $kategori)
            <li class="list-group-item">
                <a href="{{ '?sirala='.$sirala.'&kats=' . ($_kats . ',' . $kategori->slug) }}">
                    <i class="fa {{ $kategori->check ? 'fa-check-circle-o' : 'fa-circle-o' }}"></i> 
                    {{ $kategori->name }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="filmler row">
    @foreach($filmler as $film)
    <div class="col col-6 film">
        <a href="{{ $film->url() }}">
            <img src="{{ $film->mini_poster() }}" alt="">
            <div class="name">{{ $film->name(30) }} <span class="puan">{{ $film->puan }}</span></div>
        </a>
    </div>
    @endforeach
</div>

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

@endsection