@extends("layouts.app")

@section("title", "Profilim")



@section("content")
<div id="profil">
    <div class="center">
        <div class="top">
            <h1 class="renkli"><span>{{ $user->username }}</span> 
                @if(Auth::user()->id == $user->id)
                <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit"></i> Profili Düzenle</a>
                @endif
            </h1>
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
        <br>
        <br>
        <br>
        <h1 class="renkli"><span style="font-size:17px;">SON İZLENEN FİLMLER</span></h1>
        <ul class="sonuclar_ul">
            @foreach($user->izlenenFilmler() as $film)
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
            @if (!count($user->izlenenFilmler()))
                Hiç film izlememiş.
                <br><br>
            @endif
        </ul>
    </div>
</div>
@endsection


@if (Auth::user()->id == $user->id)
<div class="modal fade bilgileriDuzenle" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bilgileri Düzenle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="">Mail</label>
            <input type="text" id="mail" class="form-control" value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <label for="">Avatar URL</label>
            <input type="text" id="avatar" class="form-control" value="{{ $user->avatar }}">
        </div>
        <div class="form-group">
            <label for="">Şifre</label>
            <input type="text" id="sifre" class="form-control">
            <small>* Değiştirmek istemiyorsanız boş bırakınız.</small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        <button type="button" class="btn btn-primary" @click="kaydet()">Kaydet</button>
      </div>
    </div>
  </div>
</div>
@endif