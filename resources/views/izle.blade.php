@extends("layouts.app")

@section("title", $movie->name . " izle")
<input type="hidden" id="movie_id" value="{{ $movie->id }}">
@section("content")
<style>body {background:#090D1C}</style>
<div id="izle">
    <div class="izle-bg" style="background-image: url({{ $movie->backdrop_orj() }});">&nbsp;</div>
    <div class="izle-film">
            <div id="player">
                <div class="center">
                    <div v-if="videolar.length == 0 && videoyok==false" style="height:510px; color:#aaa; text-align:center; padding-top:100px;">
                        <i class="fa fa-spinner fa-spin fa-5x"></i>
                    </div>
                    <div v-if="videolar.length == 0 && videoyok==true" style="height:510px; color:#aaa; text-align:center; padding-top:100px;">
                        <i class="fa fa-info fa-5x"></i>
                        <br>
                        Bu filme ait video eklenmemiş.
                    </div>
                    <span v-if="videolar.length > 0" v-cloak>
                        <div class="top">
                            <div class="select">
                                <span @click="menusu('m1')">Kaynak: @{{ selected.kaynak }} - @{{ selected.dil }} <i class="fa fa-angle-down"></i></span>
                                <div class="menusu m1" style="min-width:150px; margin-left:30px">
                                    <ul>
                                        <li v-for="video in videolar" @click="selected = video; menusu('m1')">
                                            @{{ video.kaynak }} - @{{ video.dil }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="select" v-if="selected.part2 != null">
                                <span @click="menusu('m2')">Part: @{{ part }} <i class="fa fa-angle-down"></i></span>
                                <div class="menusu m2" style="width:100px; margin-left:0">
                                    <ul>
                                        <li v-if="selected.part1 != null" @click="part = 1; menusu('m2')">1</li>
                                        <li v-if="selected.part2 != null" @click="part = 2; menusu('m2')">2</li>
                                        <li v-if="selected.part3 != null" @click="part = 3; menusu('m2')">3</li>
                                        <li v-if="selected.part4 != null" @click="part = 4; menusu('m2')">4</li>
                                        <li v-if="selected.part5 != null" @click="part = 5; menusu('m2')">5</li>
                                        <li v-if="selected.part6 != null" @click="part = 6; menusu('m2')">6</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="clear"></div>
                        </div>

                        <div class="player">
                            <iframe width="100%" height="500" :src="getSrc()" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                    </span>
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