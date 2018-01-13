@extends("layouts.app")

@section("title", $movie->name . " izle")

@section("content")

<div id="izle">
    <div class="izle-bg" style="background-image: url({{ $movie->backdrop_orj() }});">&nbsp;</div>
    <div class="izle-film">
            <div id="player">
                <div class="center">
                    <div class="top">
                        <div class="select">
                            Dil: İngilizce <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="select">
                            Kaynak: Fragman <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="select">
                            Part: 1 <i class="fa fa-angle-down"></i>
                        </div>

                        <div class="clear"></div>
                    </div>

                    <div class="player">
                        <iframe width="100%" height="500" src="https://www.youtube.com/embed/TyHvyGVs42U" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="info">
                    <div class="center">
                        <div class="left">
                            <img src="{{ $movie->mini_poster() }}" alt="">
                        </div>
                        <div class="right">
                            <div class="name">
                                <h1>{{ $movie->name }}</h1>
                                <ul>
                                    <li>Orjinal: <span>{{ $movie->orj_name }}</span></li>
                                    <li>Yapım Yılı: <span>{{ $movie->year }}</span></li>
                                    <li>Süre: <span>{{ $movie->duration ? $movie->duration : "Bilinmiyor" }}</span></li>
                                    <li>Puan: <span>{{ $movie->puan }}</span></li>
                                    <li>İzlenme: <span>{{ number_format($movie->seen, 0, ",", ".") }}</span></li>
                                    <div class="clear"></div>
                                </ul>
                                <div class="clear"></div>
                            </div>

                            <div class="kats">
                                <ul>
                                    @foreach($movie->categories() as $category)
                                        <li><a href="{{ url('kategori/' . $category->slug) }}">{{ $category->name }}</a></li>
                                    @endforeach
                                    <div class="clear"></div>
                                </ul>
                            </div>

                            <div class="konu">
                                <h3>Filmin konusu</h3>
                                <p>
                                    @if ($movie->overview)
                                        {{ $movie->overview }}
                                    @else
                                        <strong>{{ $movie->name }}</strong> filmine henüz bir konu eklenmemiş. 
                                        <br> Film hakkında bir kısa özet yazıp bize göndermeye ne dersiniz?
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
        </div>
    </div>
    <div id="yorumlar">
        <div class="center">
            <div class="yorumlar">
                <h1 class="renkli"><span>Film hakkında görüşlerinizi paylaşın.</span></h1>

                <div class="yorum_yap">
                    <textarea name="" id="yorum_mesaj" cols="30" rows="10" placeholder="Yorum yazınız.."></textarea>
                    <button @click="yorumYap({{ $movie->id }})">Gönder</button>
                </div>
                
                @if (!count($movie->comments()))
                <div class="yorum_yok">
                    Hiç yorum yapılmamış :/ İlk yorumu sen yap!
                </div>
                @endif
                <ul>
                    @foreach($movie->comments() as $comment)
                    <li>
                        <div class="left">
                            @if ($comment->user())
                                <img src="{{ $comment->user()->avatar }}" alt="">
                            @else
                                <img src="{{ env('DEFAULT_AVATAR') }}" alt="">
                            @endif
                        </div>
                        <div class="right">
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
                        <div class="clear"></div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="cast">
                <h1 class="renkli"><span style="border-color:#fa3556;">Oyuncular</span></h1>
                <ul>
                    @foreach($movie->actors() as $actor)
                        <li>
                            <a href="{{ $actor->url() }}">
                                <img src="{{ $actor->photo2() }}" alt="">
                                <div class="name">{{ $actor->name }}</div>
                            </a>
                        </li>
                    @endforeach
                    <div class="clear"></div>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div class="izlendi-vue">
    <input type="hidden" id="izlendi_id" value="{{ $movie->id }}">
</div>
@endsection