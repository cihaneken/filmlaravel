@extends('admin.layouts.admin')

@section("page-title", "FİLM DÜZENLE")

@section('content')

@if(isset($error))
<div class="alert alert-danger">
    {{ $error }}
</div>
<br><br>
@endif

@if(isset($success))
<div class="alert alert-success">
    {{ $success }}
</div>
<br><br>
@endif

<div id="film_edit">
    <div class="form-group">
        <label for="id">Film Seç</label>
        <select name="id" v-model="id" id="id" class="form-control">
            <option value="0">Seçmek için tıkla</option>
            @foreach($filmler as $film)
                <option value="{{ $film->id }}" >{{ $film->name }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-success" @click="filmGetir()">Filmi Düzenle</button>
    <button class="btn btn-danger pull-right" @click="filmSil()">Filmi Sil</button>

    <form action="{{ url('admin/film-edit') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" :value="id">
        <div v-if="show">
            <br>
            <div class="form-group">
                <label for="">Arkaplan</label>
                <input type="text" name="backdrop_url" class="form-control" :value="film.backdrop_url">
            </div>
            <div class="form-group">
                <label for="">Poster</label>
                <input type="text" name="poster_url" class="form-control" :value="film.poster_url">
            </div>
            <div class="form-group">
                <label for="">Puan</label>
                <input type="text" name="puan" class="form-control" :value="film.puan">
            </div>
            <div class="form-group">
                <label for="">İsim</label>
                <input type="text" name="name" class="form-control" :value="film.name">
            </div>
            <div class="form-group">
                <label for="">Orjinal isim</label>
                <input type="text" name="orj_name" class="form-control" :value="film.orj_name">
            </div>
            <div class="form-group">
                <label for="">IMDB ID</label>
                <input type="text" name="imdb_id" class="form-control" :value="film.imdb_id">
            </div>
            <div class="form-group">
                <label for="">Konu</label>
                <textarea id="" name="overview" cols="30" rows="10" class="form-control">@{{ film.overview }}</textarea>
            </div>
            <button class="btn btn-primary">Güncelle</button>
            <br>
            <br>
            <br>
        </div>
    </form>
</div>


@endsection