@extends("layouts/master")

@section("title","Posyandu")

@section("sidebar")
    <li>
        <a href="{{ route('main') }}">
            <i class="ti-home"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="active">
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
    <li class="active">
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
                <h4 class="title"><b>Ubah Posyandu</b></h4>
            </div>
        </div>
        <hr/>
        <div>
            <form action="{{ url('/posyandu_edit/update') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="form-group">
                    <label for="nomor">Nama Posyandu</label>
                    <input type="text" name="name" id="name" class="form-control" style="border:1px solid #f1f1f1;" >
                </div>
                <div class="form-group">
                    <label for="nomor">Alamat Posyandu</label>
                    <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="5"></textarea>
                </div>
                {{-- <div class="form-group" id="thumb">
                    <label for="nomor">Foto Thumbnail</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                </div> --}}
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
        url: "{{config('app.api_url')}}"+"posyandu/{{$id}}",
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer {{session()->get("token_user")}}');
        },
        success: function (data) {
            $('#name').val(data.posyandu.name);
            $('#alamat').val(data.posyandu.alamat);
        }
    });     
});
</script>
@endsection