@extends("layouts.app")

@section("title", "Liste oluştur")

@section("content")

<div id="liste" class="liste_olustur">
    <div class="center">
        <h1 class="renkli"><span style="font-size:21px;">Kendi listeni oluştur</span></h1>
        <div class="row">
           
            <div class="col col-md-7" >
                <div class="alert alert-info mx-auto" role="alert" v-if="filmler.length == 0">
                    Hiç film seçmediniz.
                </div>

                <div class="alert alert-success mx-auto" role="alert" v-if="filmler.length > 0">
                    @{{ filmler.length }} Film Eklediniz, Ortalama Puan: <b> @{{ ortalama() }} </b>
                </div>

                <div class="filmler">
                    <div class="film" v-for="film in filmler">            
                        <img :src="film.backdrop_url" width="100%" alt="">
                        <div class="bilgi">
                            <div class="left">
                                <a href="{{ url('/') }}">
                                    <img :src="film.poster_url.replace('w1280', 'w300')" alt="">
                                </a>
                            </div>

                            <div class="right" style="width:370px">
                                <a href="{{ url('/') }}">
                                    <div class="name">@{{ film.name }} <span class="puan">@{{ film.puan }}</span></div>
                                </a>
                                <div class="konu">
                                    @{{ film.overview.substring(0, 200)+".." }}
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>

             <div class="col col-md-5 pull-right">
                <div class="form-group">
                    <div class="row">
                        <div class="col col-md-3"><label for="exampleFormControlSelect1">Film seç</label></div>
                        <div class="col col-md-9">
                            <select v-model='secili' class="form-control" id="exampleFormControlSelect1">
                                <option value="0">Seçmek için tıkla</option>
                                @foreach($filmler as $film)
                                <option value="{{ $film->id }}">{{ $film->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary pull-right" @click="filmEkle()">Listeye Ekle</button>
                <div class="clear"></div>
                <br><br>
                <div class="form-group">
                    <div class="row">
                        <div class="col col-md-3"><label for="exampleFormControlSelect1">Liste adı</label></div>
                        <div class="col col-md-9">
                            <input type="text" class="form-control" v-model="name">
                        </div>
                    </div>
                </div>
                <button class="btn btn-success pull-right" @click="paylas()">Listeyi Paylaş</button>
            </div>
        </div>
    </div>
</div>

@endsection