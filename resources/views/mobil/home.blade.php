@extends("mobil.mobil")

@section('content')
<h5><i class="fa fa-clock-o" style="color:orange"></i> &nbsp;SON EKLENENLER</h5>

<div class="filmler row">
    @foreach($movies as $film)
    <div class="col col-6 film">
        <a href="{{ $film->url() }}">
            <img src="{{ $film->mini_poster() }}" alt="">
            <div class="name">{{ $film->name(30) }} <span class="puan">{{ $film->puan }}</span></div>
        </a>
    </div>
    @endforeach
</div>
@endsection