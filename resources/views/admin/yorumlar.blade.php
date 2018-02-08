@extends('admin.layouts.admin')

@section("page-title", "YORUMLAR")

@section('content')
<div id="videolar">
    <form action="{{ url('admin/yorumlar') }}" method="get">
    <div class="form-group">
        <label for="">Film seç</label>
        <select name="id" id="" class="form-control">
            <option value="0">Seçmek için tıkla</option>
            @foreach($filmler as $film)
            <option value="{{ $film->id }}" {{ $film->id == $id ? 'selected':null }}>{{ $film->name }}</option>
            @endforeach
        </select>
    </div>
    

    <button class="btn btn-primary">Filme ait yorumları getir</button>
    </form>

    <br><br>
    <div class="alert alert-info" v-if="videoyok">
        Bu filme ait video bulunmadı.
    </div>

    <table class="table">
        <tr>
            <th>Film</th>
            <th>Yorum</th>
            <th>Onay</th>
            <th></th>
        </tr>
        @foreach($yorumlar as $yorum)
        <tr>
            <td>{{ $yorum->film()->name }}</td>
            <td>{{ $yorum->body }}</td>
            <td>{{ $yorum->is_checked ? 'Onaylandı' : 'Hayır' }}</td>
            <td>
                
                <a href="{{ url('admin/yorum-onayla/'.$yorum->id) }}" class="btn btn-success">Onayla</a>
            
                <a href="{{ url('admin/yorum-sil/'.$yorum->id) }}" class="btn btn-danger">Sil</a>   
                
            </td>
        </tr>
        @endforeach
    </table>

</div>
@endsection