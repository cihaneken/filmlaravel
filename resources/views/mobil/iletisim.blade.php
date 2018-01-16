@extends("mobil.mobil")

@section('content')
<div class="container" id="auth">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="renkli"><span><i class="fa fa-envelope" style="color:orange"></i> &nbsp;İLETİŞİM</span></h5>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('/iletisim') }}">
                        {{ csrf_field() }}
                        @if(isset($error))
                        <div class="alert alert-danger" role="alert">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <span class="sr-only">Hata:</span>
                            {{ $error }}
                        </div>
                        @endif
                        @if(isset($success))
                        <div class="alert alert-success" role="success">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <span class="sr-only">Başarılı:</span>
                            {{ $success }}
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="isim" class="col-md-4 control-label">İsim</label>

                            <div class="col-md-6">
                                <input id="isim" type="text" class="form-control" name="isim" value="{{ old('username') }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mail" class="col-md-4 control-label">Mail</label>

                            <div class="col-md-6">
                                <input id="mail" type="mail" class="form-control" name="mail" value="{{ old('username') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="konu" class="col-md-4 control-label">Konu</label>

                            <div class="col-md-6">
                                <input id="konu" type="text" class="form-control" name="konu" value="{{ old('username') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mesaj" class="col-md-4 control-label">Mesajınız</label>

                            <div class="col-md-6">
                                <textarea name="mesaj" id="mesaj" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Gönder
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