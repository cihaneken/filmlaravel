@extends("mobil.mobil")

@section('content')
<div class="container" id="auth">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="renkli"><span><i class="fa fa-plus" style="color:orange"></i> &nbsp;ARAMIZA KATIL</span></h5>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('/auth/kayit') }}">
                        {{ csrf_field() }}

                        @if(isset($error))
                        <div class="alert alert-danger" role="alert">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <span class="sr-only">Hata:</span>
                            {{ $error }}
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="username" class="col-md-4 control-label">Kullanıcı Adı</label>
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username" class="col-md-4 control-label">E-Posta</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Şifre</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Kayıt Ol
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection