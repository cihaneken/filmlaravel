@extends('admin.layouts.admin')

@section("page-title", "VİDEO EKLE")

@section('content')
<div id="video_ekle">
    <div class="form-group">
        <label for="id">Film Seç</label>
        <select name="id" v-model="id" id="id" class="form-control">
            <option value="0">Seçmek için tıkla</option>
            @foreach($filmler as $film)
                <option value="{{ $film->id }}">{{ $film->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="dil">Dil Seç</label>
        <select name="dil" v-model="dil" id="dil" class="form-control">
            <option value="0">Seçmek için tıkla</option>
            <option value="fragman">Fragman</option>
            <option value="dublaj">Türkçe Dublaj</option>
            <option value="altyazi">Türkçe Altyazı</option>
        </select>
    </div>
    <div class="form-group">
        <label for="dil">Kaynak Adı</label>
        <input type="text" v-model="kaynak" class="form-control" placeholder="ok.ru">
    </div>
    <div class="alert alert-info">
        Eğer tek part video ekleyecekseniz sadece part 1 e yazmanız yeterli.
        Part 1 hariç gerisi boş olabilir.
        <br><br>
        Partlara sadece <b>iframe SRC</b> eklenmlidir.
    </div>
    <div class="form-group">
        <label for="dil">Part 1</label>
        <input type="text" v-model="part1" class="form-control" placeholder="">
    </div>
    <div class="form-group">
        <label for="dil">Part 2</label>
        <input type="text" v-model="part2" class="form-control" placeholder="">
    </div>
    <div class="form-group">
        <label for="dil">Part 3</label>
        <input type="text" v-model="part3" class="form-control" placeholder="">
    </div>

    <div class="form-group">
        <label for="dil">Part 4</label>
        <input type="text" v-model="part4" class="form-control" placeholder="">
    </div>

    <div class="form-group">
        <label for="dil">Part 5</label>
        <input type="text" v-model="part5" class="form-control" placeholder="">
    </div>

    <div class="form-group">
        <label for="dil">Part 6</label>
        <input type="text" v-model="part6" class="form-control" placeholder="">
    </div>

    <button class="btn btn-success" @click="ekle()">Ekle</button>
</div>
@endsection