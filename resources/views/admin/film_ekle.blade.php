@extends('admin.layouts.admin')

@section("page-title", "FİLM EKLE")

@section('content')
<div class="alert alert-info" role="alert">
    Filmi eklemek için aşağıdaki kutuya filmin TMDB id ( <em>https://www.themoviedb.org/</em> ) sini girmelisiniz.
    <br><br>
    Örnek: https://www.themoviedb.org/movie/<b>472454</b>-ayla-the-daughter-of-war <br>
    Ayla filmine ait olan bu linkte, film idsi <b>472454</b> dir.
</div>
<br>
<br>
<div class="form-group" id="film-ekle">
    <label for="id">Film TMBD ID</label>
    <input type="text" class="form-control" v-model="id" placeholder="472454">
    <br>
    <button class="btn btn-success" @click="ekle(id)"><i class="fa fa-plus"></i> Ekle</button>
</div>
@endsection