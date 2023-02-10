@extends("layouts/master")

@section("title","Manajemen User")

@section("sidebar")
    <li>
        <a href="{{ route('main') }}">
            <i class="ti-home"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="">
        <a href="{{ route('berita') }}">
            <i class="fas fa-train"></i>
            <p>Berita</p>
        </a>
    </li>
    <li class="">
        <a href="{{ route('rapot') }}">
            <i class="fas fa-book"></i>
            <p>RAPOT ANAK</p>
        </a>
    </li>
    @if (session()->get('roles') == 'admin')
    <li class="">
        <a href="{{ route('posyandu') }}">
            <i class="fas fa-hospital"></i>
            <p>POSYANDU</p>
        </a>
    </li>
    <li class="active">
        <a href="{{ route('user') }}">
            <i class="fas fa-user"></i>
            <p>MANAJEMEN USER</p>
        </a>
    </li>
    @endif
@endsection
@section("content")
<div class="col-md-12">
    <div class="card card-plain">
        <div class="header row">
            <div class="col-lg-9">
                <h4 class="title"><b>Detail Berita</b></h4>
            </div>
            <div class="col-lg-3 thumbnail" style="width: 250px; float: right;">
            </div>
        </div>
        <hr/>
        <div class="berita" style="background-color: white; padding: 20px;">
        </div>
    </div>
</div>
@endsection

@section("js")
<script>
$(document).ready(function() {
    $.ajax({
        url: "{{config('app.api_url')}}"+"berita/{{$id}}",
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer {{session()->get("token_user")}}');
        },
        success: function (data) {
            $('.berita').html(data.berita.description);
            $('.thumbnail').append(`<img src=${data.berita.photo}>`);
         }
    });     
});
</script>
@endsection