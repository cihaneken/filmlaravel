@extends('admin.layouts.admin')

@section("page-title", "KULLANICILAR")

@section('content')
<div id="admin">
    <table class="table table-dark">
        <tr>
        <th scope="col">#</th>
        <th scope="col">K.Adı</th>
        <th scope="col">Mail</th>
        <th scope="col">Admin mi?</th>
        <th></th>
        <th></th>
        </tr>
        @foreach($kullanicilar as $kullanici)
        <tr>
            <th scope="row">{{ $kullanici->id }}</th>
            <td>{{ $kullanici->username }}</td>
            <td>{{ $kullanici->email }}</td>
            <td>{{ $kullanici->is_admin ? "Evet" : "Hayır" }}</td>
            <td><button class="btn btn-primary btn-sm" @click="adminToggle({{ $kullanici->id }})">Adminlik Ver/Al</button></td>
            <td><button class="btn btn-danger btn-sm" @click="adminSil({{ $kullanici->id }})">Sil</button></td>
        </tr>
        @endforeach
    </table>
</div>
@endsection