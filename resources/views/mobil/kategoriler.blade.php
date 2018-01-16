@extends("mobil.mobil")

@section('content')
<h5><i class="fa fa-bars" style="color:orange"></i> &nbsp;KATEGORİLER</h5>

<div id="kategoriler">
    <ul class="list-group">
        @foreach($kategoriler as $kategori)
            <li class="list-group-item" style="background:#2b2f4c;">
                <a href="{{ url('kategori/' . $kategori->slug) }}" style="color:#fff; font-weight:bold;">
                    <div class="name"> {{ $kategori->name }} ({{ $kategori->filmSayisi() }})</div>
                </a>
            </li>
        @endforeach
    </ul>
</div>


@endsection