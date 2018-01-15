<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/tv.png') }}"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ url('/') }}">

    <title>{{ config('app.name', 'Movie V1') }} - @yield("title", "Film izle")</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css?v=1.'.rand(0,99999)) }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div id="header">
            <!-- HEADER -->
            <div class="center top">
                <div class="logo">
                    {{ config('app.name', 'Movie V1') }}
                </div>
                <div class="user show_mobil">
                    @if(!Auth::check())
                    <a href="{{ url('/auth/giris') }}" class="user-button giris">Giriş Yap</a>
                    <a href="{{ url('/auth/kayit') }}" class="user-button kayit">Kayıt Ol</a>
                    @else
                    <div class="giris_yapildi">
                        @if(Auth::user()->is_admin)
                            <a style="display: inline-block;margin-top: 7px;" href="{{ url('admin') }}" id="admin_link">
                                <i class="fa fa-cog fa-2x"></i>
                            </a>
                        @endif
                        <a href="{{ url('auth/profil') }}">
                            <div class="name">
                                {{ Auth::user()->username }} <i class="fa fa-angle-right"></i>
                            </div>
                            <img src="{{ Auth::user()->avatar }}" alt="">
                        </a>
                    </div>
                    @endif
                </div>
                <div class="search show_tam">
                    <form action="{{ url('/ara') }}">
                        <input type="text" name="q" value="{{ isset($q) ? $q:null }}" placeholder="Film veya oyuncu ara..">
                        <button><i class="fa fa-search fa-lg"></i></button>
                    </form>
                </div>
                <div class="show_mobil clear"></div>
                <div class="search show_mobil">
                    <form action="{{ url('/ara') }}">
                        <input type="text" name="q" value="{{ isset($q) ? $q:null }}" placeholder="Film veya oyuncu ara..">
                        <button><i class="fa fa-search fa-lg"></i></button>
                    </form>
                </div>
                <div class="user show_tam">
                    @if(!Auth::check())
                    <a href="{{ url('/auth/giris') }}" class="user-button giris">Giriş Yap</a>
                    <a href="{{ url('/auth/kayit') }}" class="user-button kayit">Kayıt Ol</a>
                    @else
                    <div class="giris_yapildi">
                        @if(Auth::user()->is_admin)
                            <a style="display: inline-block;margin-top: 7px;" href="{{ url('admin') }}" id="admin_link">
                                <i class="fa fa-cog fa-2x"></i>
                            </a>
                        @endif
                        <a href="{{ url('auth/profil') }}">
                            <div class="name">
                                {{ Auth::user()->username }} <i class="fa fa-angle-right"></i>
                            </div>
                            <img src="{{ Auth::user()->avatar }}" alt="">
                        </a>
                    </div>
                    @endif
                </div>

                <div class="clear"></div>
            </div>

            <div class="menu">
                <div class="center">
                    <ul>
                        <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Anasayfa</a></li>
                        <li><a href="{{ url('/arsiv') }}"><i class="fa fa-archive"></i> Film Arşivi</a></li>
                        <li><a href="{{ url('/kategoriler') }}"><i class="fa fa-bars"></i> Kategoriler</a></li>
                        <li><a href="{{ url('/listeler') }}"><i class="fa fa-diamond"></i> Listeler</a></li>
                        <li><a href="{{ url('/rastgele') }}"><i class="fa fa-random"></i> Rastgele</a></li>
                        <li><a href="{{ url('/iletisim') }}"><i class="fa fa-envelope"></i> İletişim</a></li>

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
        
        <div id="cage">
            @yield('content')
        </div>
        <div class="clear"></div>
        <!-- Footer -->
        <div id="footer">
            <div class="center">
                Deneme
            </div>
        </div>
        <!-- @Footer -->

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
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="{!! asset('js/app.js?v=11'.rand(0,99999) !!}"></script>
    <script src="{!! asset('js/owl.carousel.min.js') !!}"></script>
    <script src="{!! asset('js/main.js') !!}"></script>
</body>
</html>
