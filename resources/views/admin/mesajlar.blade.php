@extends('admin.layouts.admin')

@section("page-title", "MESAJLAR")

@section('content')
<div id="mesajlar">
    <table class="table table-dark">
        <tr>
        <th scope="col">#</th>
        <th scope="col">İsim</th>
        <th scope="col">Konu</th>
        <th></th>
        <th></th>
        </tr>
        @foreach($mesajlar as $mesaj)
        <tr>
            <th scope="row">{{ $mesaj->id }}</th>
            <td>{{ $mesaj->isim }}</td>
            <td>{{ $mesaj->konu }}</td>
            <td><button class="btn btn-primary btn-sm" @click="oku({{ $mesaj->id }})"><i class="fa fa-search"></i> Oku</button></td>
            <td><button class="btn btn-danger btn-sm" @click="sil({{ $mesaj->id }})">Sil</button></td>
        </tr>
        @endforeach
    </table>
</div>
@endsection