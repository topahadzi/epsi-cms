@extends("layouts/master")

@section("title","Berita")

@section("sidebar")
    <li>
        <a href="{{ route('main') }}">
            <i class="ti-home"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="active">
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
    <li class="">
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
            <div class="col-lg-10">
                <h4 class="title"><b>Ubah Berita</b></h4>
            </div>
        </div>
        <hr/>
        <div>
            <form action="{{ url('/berita_edit/update') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="form-group">
                    <label for="nomor">Judul</label>
                    <input type="text" class="form-control" id="title" style="border:1px solid #f1f1f1;" name="title">
                </div>
                <div class="form-group" id="thumb">
                    <label for="nomor">Foto Thumbnail</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nomor">Deskripsi</label>
                    <textarea class="ckeditor form-control" id="ckeditor" name="description"></textarea>
                </div>
                <input type="hidden" name="id" value="{{$id}}">
                <button class="btn btn-primary active" style="border-radius:0;">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section("js")
<script>
$(document).ready(function() {
    // CKEDITOR.replace( 'ckeditor' );
    
    $.ajax({
        url: "{{config('app.api_url')}}"+"berita/{{$id}}",
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer {{session()->get("token_user")}}');
        },
        success: function (data) {
            $('#title').val(data.berita.title);
            $('#thumb').append(`<img src="${data.berita.photo}" style="width: 250px; margin: 20px 0px 0px 0px;">`);
            $('#ckeditor').val(data.berita.description);
        }
    });     
});
</script>
@endsection