@extends("layouts/master")

@section("title","Dashboard")

@section("sidebar")
    <li class="active">
        <a href="{{ route('main') }}">
            <i class="ti-home"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li>
        <a href="{{ route('berita') }}">
            <i class="fas fa-newspaper"></i>
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
    <li class="">
        <a href="{{ route('user') }}">
            <i class="fas fa-user"></i>
            <p>MANAJEMEN USER</p>
        </a>
    </li>
    @endif
@endsection
@section("content")
<div class="col-lg-12 col-sm-12">
    <div class="card">
        <div class="content">
            <div class="row">
                <form action="{{ url('/lokasi_posyandu_update') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="nomor">Pilih Lokasi Posyandu Anda</label>
                                <select name="posyandu" id="posyandu" class="form-control">
                                    <option value="">-- Pilih Posyandu --</option>
                                </select>
                            </div>
                        <button  class="btn btn-primary active" style="border-radius:0;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section("js")
<script>
    $(document).ready(function() {
        $.ajax({
            url: "{{config('app.api_url')}}"+"posyandu",
            type: 'GET',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer {{session()->get("token_user")}}');
            },
            success: function (data) {
                for (let i = 0; i < data.posyandu.length; i++) {
                    $('#posyandu').append(`<option value="${data.posyandu[i]._id}">${data.posyandu[i].name}</option>`)
                }
             }
        });     
    });
    </script>
@endsection