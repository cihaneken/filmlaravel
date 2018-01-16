<!doctype html>
<html lang="tr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ url('/') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/mobil.css?v=1.'.rand(0,9999)) }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Hello, world!</title>
</head>
<body>
    <div class="container-fluid">
        <div id="header">
            <div class="row top">
                <div class="col col-sm-6 logo">
                    <i class="fa fa-tv"></i> {{ config('app.name') }}
                </div>
                <div class="col col-sm-6 user text-right">
                    <div class="row">
                        <div class="col col-sm-6">
                            <a href="{{ url('auth/kayit') }}" class="btn"><i class="fa fa-user-plus fa-lg"></i> Kayıt</a>
                        </div>
                        <div class="col col-sm-6">
                            <a href="{{ url('auth/giris') }}" class="btn"><i class="fa fa-user fa-lg"></i> Giriş</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row menu">
                <div class="col col-5">
                    <button class="btn btn-indigo" @click="showMenu()"><i class="fa fa-bars fa-lg"></i></button>
                </div>
                <div class="col col-7 pull-right">
                    <form action="{{ url('/ara') }}">
                        <div class="input-group">
                            <input type="text" class="form-control" value="{{ isset($q) ? $q : null }}" placeholder="Film ara.." name="q">
                            
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="popMenu">
            <ul class="list-group">
                <li class="list-group-item"><a href="{{ url('/') }}"><i class="fa fa-home"></i> Anasayfa</a></li>
                <li class="list-group-item"><a href="{{ url('/arsiv') }}"><i class="fa fa-archive"></i> Arşiv</a></li>
                <li class="list-group-item"><a href="{{ url('/kategoriler') }}"><i class="fa fa-bars"></i> Kategoriler</a></li>
                <li class="list-group-item"><a href="{{ url('/rastgele') }}"><i class="fa fa-random"></i> Rastgele</a></li>
                <li class="list-group-item"><a href="{{ url('/iletisim') }}"><i class="fa fa-envelope"></i> İletişim</a></li>
            </ul>
        </div>
        <div id="content">
            @yield('content')
        </div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/mobil.js?v=1.' . rand(0,99999)) }}"></script>
</body>
</html>