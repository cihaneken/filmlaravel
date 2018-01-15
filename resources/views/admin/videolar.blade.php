@extends('admin.layouts.admin')

@section("page-title", "VİDEOLAR")

@section('content')
<div id="videolar">
    <div class="form-group">
        <label for="">Film seç</label>
        <select v-model="id" name="id" id="" class="form-control">
            <option value="0">Seçmek için tıkla</option>
            @foreach($filmler as $film)
            <option value="{{ $film->id }}">{{ $film->name }}</option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-primary" @click="getir()">Filme ait videoları getir</button>


    <br><br>
    <div class="alert alert-info" v-if="videoyok">
        Bu filme ait video bulunmadı.
    </div>

    <table class="table" v-if="videolar.length != 0">
        <tr>
            <th>Kaynak</th>
            <th>Dil</th>
            <th>Part1</th>
            <th>Part2</th>
            <th>Part3</th>
            <th>Part4</th>
            <th>Part5</th>
            <th>Part6</th>
            <th>Sil</th>
            <th>Düzenle</th>
        </tr>
        <tr v-for="video in videolar">
            <td>@{{ video.kaynak }}</td>
            <td>@{{ video.dil }}</td>
            <td><a :href="video.part1" class="btn btn-primary btn-sm"><i class="fa fa-play"></i></a></td>
            <td><a v-if="video.part2 != null" :href="video.part2" class="btn btn-primary btn-sm"><i class="fa fa-play"></i></a></td>
            <td><a v-if="video.part3 != null" :href="video.part3" class="btn btn-primary btn-sm"><i class="fa fa-play"></i></a></td>
            <td><a v-if="video.part4 != null" :href="video.part4" class="btn btn-primary btn-sm"><i class="fa fa-play"></i></a></td>
            <td><a v-if="video.part5 != null" :href="video.part5" class="btn btn-primary btn-sm"><i class="fa fa-play"></i></a></td>
            <td><a v-if="video.part6 != null" :href="video.part6" class="btn btn-primary btn-sm"><i class="fa fa-play"></i></a></td>
            <td><a href="#" class="btn btn-sm btn-danger" @click="sil( video.id )"><i class="fa fa-times"></i></a></td>
            <td><a :href="'/admin/video-edit/'+video.id" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a></td>
        </tr>
    </table>

</div>
@endsection