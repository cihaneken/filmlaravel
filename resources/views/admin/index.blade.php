@extends('admin.layouts.admin')

@section('content')
<div class="card-gosterim row">
    <div class="col col-md-4">
        <div class="text"><i class="fa fa-users"></i> Üyeler</div>
        <div class="sayi">{{ $uyeler }}</div>
    </div>
    <div class="col col-md-4">
        <div class="text"><i class="fa fa-comments"></i> Yorumlar</div>
        <div class="sayi">{{ $yorumlar }}</div>
    </div>
    <div class="col col-md-4">
        <div class="text"><i class="fa fa-tv"></i> Gösterim</div>
        <div class="sayi">{{ $gosterim }}</div>
    </div>
    <div class="col col-md-4">
        <div class="text"><i class="fa fa-diamond"></i> Listeler</div>
        <div class="sayi">{{ $listeler }}</div>
    </div>
    <div class="col col-md-4">
        <div class="text"><i class="fa fa-user-circle"></i> Oyuncular</div>
        <div class="sayi">{{ $oyuncular }}</div>
    </div>
</div>
@endsection