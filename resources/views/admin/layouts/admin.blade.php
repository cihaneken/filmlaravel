<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/tv.png') }}"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ url('/') }}">

    <title>{{ config('app.name', 'Movie V1') }} - @yield("title", "Admin Panel")</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css?v=1.'.rand(0,99999)) }}" rel="stylesheet">
</head>
<body>
    <div id="header">
        &nbsp;
    </div>
    <div class="container">
        <div class="row">
            <div class="col col-md-3">
                <div id="sidebar">
                    <div class="logo">{{ config('app.name') }} <a href="{{ url('/') }}" target="_blank" class="btn btn-info">Siteyi Gör</a> </div> 
                    <ul class="menu">
                        <li><a href="{{ url('admin') }}"><i class="fa fa-home"></i> Anasayfa</a></li>
                        <li><a href="{{ url('admin/film-ekle') }}"><i class="fa fa-tv"></i> Film Ekle</a></li>
                        <li><a href="{{ url('admin/film-edit') }}"><i class="fa fa-edit"></i> Film Düzenle</a></li>
                        <li><a href="{{ url('admin/kullanicilar') }}"><i class="fa fa-users"></i> Kullanıcılar</a></li>
                        <li><a href="{{ url('admin/mesajlar') }}"><i class="fa fa-envelope"></i> Mesajlar</a></li>
                        <li><a href="{{ url('admin/videolar') }}"><i class="fa fa-play"></i> Videolar</a></li>
                        <li><a href="{{ url('admin/yorumlar') }}"><i class="fa fa-comments"></i> Yorumlar</a></li>
                        <li><a href="{{ url('admin/video-ekle') }}"><i class="fa fa-plus"></i> Video Ekle</a></li>
                    </ul>
                </div>
            </div>
            <div class="col col-md-8 pulk-right">
                <div id="content">
                    <h1 class="renkli"><span style="font-size:21px;padding-right:50px;border-color:#fa3556;">@yield('page-title', "YÖNETİM PANELİ")</span></h1>

                    @yield('content')
            </div>
            
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="customAlert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn modal-close btn-secondary" data-dismiss="modal">Kapat</button>
            </div>
            </div>
        </div>
    </div>
    <!-- @Modal -->
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="{!! asset('js/app.js?v=11'.rand(0,99999)) !!}"></script>
</body>
</html>