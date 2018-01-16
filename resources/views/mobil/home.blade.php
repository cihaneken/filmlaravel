<!doctype html>
<html lang="tr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/mobil.css') }}">
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
                            <a href="#" class="btn"><i class="fa fa-user-plus fa-lg"></i> Kayıt</a>
                        </div>
                        <div class="col col-sm-6">
                            <a href="#" class="btn"><i class="fa fa-user fa-lg"></i> Giriş</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row menu">
                <div class="col col-3">
                    <button class="btn btn-indigo"><i class="fa fa-bars fa-lg"></i></button>
                </div>
                <div class="col col-9">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Film ara.." aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
        </div>

        <div id="content">
            <h5>SON EKLENENLER</h5>

            <div class="filmler row">
                @foreach($movies as $film)
                <div class="col col-6 film">
                    <a href="{{ $film->url() }}">
                        <img src="{{ $film->mini_poster() }}" alt="">
                        <div class="name">{{ $film->name(30) }} <span class="puan">{{ $film->puan }}</span></div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script>
</body>
</html>