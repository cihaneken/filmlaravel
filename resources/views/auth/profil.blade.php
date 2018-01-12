@extends("layouts.app")

@section("title", "Profilim")

@if ($user->sonIzlenen())
<div class="auth-bg" style="background:url({{ $user->sonIzlenen()->backdrop_orj() }});">
    &nbsp;
</div>
@endif

@section("content")
<div id="profil">
    <div class="center">
        <div class="top">
            <h1 class="renkli"><span>{{ $user->username }}</span></h1>
            <div class="avatar">
                <img src="{{ $user->avatar }}" alt="{{ $user->username }} avatarı">
            </div>
            <ul class="info">
                <li class="info">
                    <div class="text"><i class="fa fa-bar-chart"></i> İzlenen Filmler</div>
                    <span> {{ count($user->izlemeler()) }} </span>
                </li>
                <li class="info">
                    <div class="text"><i class="fa fa-comments"></i> Yapılan Yorumlar</div>
                    <span>316</span>
                </li>
                <li class="info">
                    <div class="text"><i class="fa fa-calendar"></i> Kayıt</div>
                    <span>{{ str_replace("-", "/", explode(" ", $user->created_at)[0]) }}</span>
                </li>
                <li class="info">
                    <div class="text"><i class="fa fa-tv"></i> Son İzlediği Film</div>
                    <span>
                        @if (!$user->sonIzlenen())
                            <a href="#">Henüz film izlemedi.</a>
                        @else
                            <a href="{{ $user->sonIzlenen()->url() }}" title="{{ $user->sonIzlenen()->name }} filmini izlemek için tıkla!">{{ $user->sonIzlenen()->name(30) }}</a>
                        @endif
                    </span>
                </li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
</div>
@endsection