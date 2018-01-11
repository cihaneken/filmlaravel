<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Movie V1') }} - @yield("title", "Film izle")</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div id="header">
            <!-- HEADER -->
            <div class="center top">
                <div class="logo">
                    {{ config('app.name', 'Movie V1') }}
                </div>

                <div class="search">
                    <input type="text" placeholder="Film veya oyuncu ara..">
                    <button><i class="fa fa-search fa-lg"></i></button>
                </div>
                
                <div class="user">
                    <a href="#" class="user-button giris">Giriş Yap</a>
                    <a href="#" class="user-button kayit">Kayıt Ol</a>
                </div>

                <div class="clear"></div>
            </div>

            <div class="menu">
                <div class="center">
                    <ul>
                        <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Anasayfa</a></li>
                        <li><a href="{{ url('/arsiv') }}"><i class="fa fa-archive"></i> Film Arşivi</a></li>
                        <li><a href="{{ url('/kategoriler') }}"><i class="fa fa-bars"></i> Kategoriler</a></li>
                        <li><a href="#"><i class="fa fa-diamond"></i> Seçtiklerimiz</a></li>
                        <li><a href="#">Yerli Filmler</a></li>
                        <li><a href="#">Yabancı Filmler</a></li>

                        <div class="clear"></div>
                    </ul>
                </div>
            </div>
            
            <div class="speacial-menu">
                <div class="center">
                    <ul>
                        <li><a href="#"><i class="fa fa-clock-o"></i> En Son Eklenen Filmler</a></li>
                        <li><a href="#"><i class="fa fa-thumbs-up"></i> En Çok İzlenen Filmler</a></li>
                        <li><a href="#"><i class="fa fa-comments"></i> En Çok Yorumlanan Filmler</a></li>

                        <div class="clear"></div>
                    </ul>
                </div>
            </div>

            <!-- @HEADER -->
        </div>
        
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
