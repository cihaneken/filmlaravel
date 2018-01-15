@extends('admin.layouts.admin')

@section("page-title", "VİDEO DÜZENLE")

@section('content')
<form action="/admin/video-edit" method="post">
<input type="hidden" name="vid" value="{{ $video->id }}">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div id="video_edit">
    <div class="form-group">
        <label for="id">Film Seç</label>
        <select name="id" v-model="id" id="id" class="form-control">
            <option value="0">Seçmek için tıkla</option>
            @foreach($filmler as $film)
                <option value="{{ $film->id }}" {{ $film->id == $video->movie_id ? 'selected' : null }}>{{ $film->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="dil">Dil Seç</label>
        <select name="dil" v-model="dil" id="dil" class="form-control">
            <option value="0">Seçmek için tıkla</option>
            <option value="fragman" {{ $video->dil == 'fragman' ? 'selected' : null }}>Fragman</option>
            <option value="dublaj" {{ $video->dil == 'dublaj' ? 'selected' : null }}>Türkçe Dublaj</option>
            <option value="altyazi" {{ $video->dil == 'altyazi' ? 'selected' : null }}>Türkçe Altyazı</option>
        </select>
    </div>
    <div class="form-group">
        <label for="dil">Kaynak Adı</label>
        <input type="text" v-model="kaynak" name="kaynak" class="form-control" placeholder="ok.ru" value="{{ $video->kaynak }}">
    </div>
    <div class="alert alert-info">
        Eğer tek part video ekleyecekseniz sadece part 1 e yazmanız yeterli.
        Part 1 hariç gerisi boş olabilir.
        <br><br>
        Partlara sadece <b>iframe SRC</b> eklenmlidir.
    </div>
    <div class="form-group">
        <label for="dil">Part 1</label>
        <input type="text" v-model="part1" name="part1" class="form-control" placeholder="" value="{{ $video->part1 }}">
    </div>
    <div class="form-group">
        <label for="dil">Part 2</label>
        <input type="text" v-model="part2" name="part2" class="form-control" placeholder="" value="{{ $video->part2 }}">
    </div>
    <div class="form-group">
        <label for="dil">Part 3</label>
        <input type="text" v-model="part3" name="part3" class="form-control" placeholder="" value="{{ $video->part3 }}">
    </div>

    <div class="form-group">
        <label for="dil">Part 4</label>
        <input type="text" v-model="part4" name="part4" class="form-control" placeholder="" value="{{ $video->part4 }}">
    </div>

    <div class="form-group">
        <label for="dil">Part 5</label>
        <input type="text" v-model="part5" name="part5" class="form-control" placeholder="" value="{{ $video->part5 }}">
    </div>

    <div class="form-group">
        <label for="dil">Part 6</label>
        <input type="text" v-model="part6" name="part6" class="form-control" placeholder="" value="{{ $video->part6 }}">
    </div>

    <button class="btn btn-success" @click="ekle()">Güncelle</button>
</div>
</form>
@endsection