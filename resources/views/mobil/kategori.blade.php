@extends("mobil.mobil")

@section('content')
<h5><i class="fa fa-clock-o" style="color:orange"></i> &nbsp; {{ $kategori->name }} ({{ $kategori->filmSayisi() }})</h5>
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
        <li><a href="{{ '&page='. $i }}" class="{{ $i == $filmler->currentPage() ? 'aktif' : null }}">{{ $i }}</a></li>
        @endfor

        <div class="clear"></div>
    </ul>
</div>
@endif

@endsection