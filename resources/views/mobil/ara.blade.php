@extends("mobil.mobil")

@section('content')
<h5><i class="fa fa-search" style="color:orange"></i> &nbsp;ARAMA SONUÇLARI</h5>

<div class="arama row">
    <div class="col col-6">
        <h5><i class="fa fa-tv"></i> Filmler</h5>
        <div class="filmler">
            @foreach($filmler as $film)
            <div class=" film">
                <a href="{{ $film->url() }}">
                    <img style="height:auto" src="{{ $film->mini_poster() }}" alt="">
                    <div class="name">{{ $film->name(30) }} <span class="puan">{{ $film->puan }}</span></div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col col-6">
        <h5><i class="fa fa-user-circle"></i> Oyuncular</h5>
        <div class="filmler">
            @foreach($oyuncular as $oyuncu)
            <div class=" film">
                <a href="{{ $oyuncu->url() }}">
                    <img style="height:auto" src="{{ $oyuncu->photo2() }}" alt="">
                    <div class="name">{{ $oyuncu->name }} </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>


@endsection