@extends("mobil.mobil")

@section('content')
<h5><i class="fa fa-clock-o" style="color:orange"></i> &nbsp; <span style="color:orange">{{ $user->username }}</span> Son İzledikleri</h5>
<div class="filmler row">
    @foreach($user->izlenenFilmler() as $film)
    <div class="col col-6 film">
        <a href="{{ $film->url() }}">
            <img src="{{ $film->mini_poster() }}" alt="">
            <div class="name">{{ $film->name(30) }} <span class="puan">{{ $film->puan }}</span></div>
        </a>
    </div>
    @endforeach
</div>
@endsection