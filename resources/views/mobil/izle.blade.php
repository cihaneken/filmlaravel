@extends("mobil.mobil")
@section("title", $movie->name . " izle")
@section('content')
<h5><i class="fa fa-play" style="color:orange"></i> &nbsp;{{ $movie->name(35) }}</h5>

<div id="player">
    <input type="hidden" id="movie_id" value="{{ $movie->id }}">

    <div v-if="videolar.length == 0 && videoyok==false" style="height:210px; color:#aaa; text-align:center; padding-top:100px;">
        <i class="fa fa-spinner fa-spin fa-3x"></i>
    </div>
    <div v-if="videolar.length == 0 && videoyok==true" style="height:210px; color:#aaa; text-align:center; padding-top:5px;">
        <i class="fa fa-info fa-5x"></i>
        <br>
        <h3>Bu filme ait video eklenmemiş.</h3>
    </div>
    <div class="form-group row" v-if="videolar.length > 0" v-cloak>
        <div class="col col-7" >
            <label for="">Kaynak</label>
            <select name="kaynak" v-model="id" id="" class="form-control">
                <option v-for="(video, index) in videolar" :value="index" >@{{ video.kaynak + " - " + video.dil }}</option>
            </select>
        </div>
        <div class="col col-5" v-if="selected.part2 != null">
            <label for="">Part</label>
            <select name="kaynak" v-model="part" id="" class="form-control">
                <option value="1" v-if="selected.part1 != null">1</option>
                <option value="2" v-if="selected.part2 != null">2</option>
                <option value="3" v-if="selected.part3 != null">3</option>
                <option value="4" v-if="selected.part4 != null">4</option>
                <option value="5" v-if="selected.part5 != null">5</option>
                <option value="6" v-if="selected.part6 != null">6</option>
            </select>
        </div>
    </div>
    <div class="row" v-if="videolar.length > 0" v-cloak>
        <div class="col">
            <iframe width="100%" height="200" :src="getSrc()" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div>
    </div>
</div>
<br>
<div class="row film-detay">
    <div class="col col-6">
        <img src="{{ $movie->mini_poster() }}" width="100%" alt="">
    </div>
    <div class="col col-6">
        <div class="name">
            {{ $movie->name }}
            <span style="color:orange">{{ $movie->puan }}</span>
        </div>
        <ul class="detay">
            <li>Orjinal: <span>{{ $movie->orj_name }}</span></li>
            <li>Yapım Yılı: <span>{{ $movie->year }}</span></li>
            <li>Süre: <span>{{ $movie->duration ? $movie->duration : "Bilinmiyor" }}</span></li>
            <li>Puan: <span>{{ $movie->puan }}</span></li>
            <li>İzlenme: <span>{{ number_format($movie->seen, 0, ",", ".") }}</span></li>
            <div class="clear"></div>
        </ul>
    </div>
</div>

<div class="row konu">
    <div class="col">
        <p>
            {{ $movie->overview }}
        </p>
    </div>
</div>

<div class="row secenekler">
    <div class="col col-6"><i class="fa fa-comments"></i> Yorumlar</div>
    <div class="col col-6"><i class="fa fa-users"></i> Oyuncular</div>
</div>

<div class="row yorumlar">
    <br>
    <div class="col">
        <div class="form-group">
            <textarea name="" id="yorum_mesaj" placeholder="Yorumunuz.."  class="form-control"></textarea>
            <br>
            <button class="btn btn-primary" @click="yorumYap({{$movie->id}})">Yorum Yap</button>
        </div>
    </div>
    
</div>
<div class="row yorum_list">
    <div class="col">
        @if (!count($movie->comments()))
        <div class="yorum_yok">
            Hiç yorum yapılmamış :/ İlk yorumu sen yap!
        </div>
        @endif
        <ul>
            @foreach($movie->comments() as $comment)
            <li>
                <div class="row">
                    <div class="col col-3 left">
                        @if ($comment->user())
                            <img src="{{ $comment->user()->avatar }}" alt="{{ $comment->user()->username }} kullanıcı avatarı">
                        @else
                            <img src="{{ env('DEFAULT_AVATAR') }}" alt="kullanıcı avatarı">
                        @endif
                    </div>
                    <div class="col col-9 right">
                        @if ($comment->user())
                        <div class="top">
                            <span class="name"><a href="{{ url('profil/' . $comment->user()->slug) }}">{{ $comment->user()->username }}</a></span> <div class="tarih">{{ $comment->created_at->diffForHumans() }}</div>
                        </div>
                        @else
                        <div class="top">
                            <span class="name">Ziyaretçi</span> <div class="tarih">{{ $comment->created_at->diffForHumans() }}</div>
                        </div>
                        @endif
                        <p class="mesaj">
                            {{ $comment->body }}
                        </p>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>

@endsection