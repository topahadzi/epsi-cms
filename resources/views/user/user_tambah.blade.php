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
            <div class="col-lg-10">
                <h4 class="title"><b>Tambah User</b></h4>
            </div>
        </div>
        <hr/>
        <div>
            <form action="{{ url('/user_tambah/create') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="form-group">
                    <label for="nomor">Nama</label>
                    <input type="text" name="name" class="form-control" style="border:1px solid #f1f1f1;" >
                </div>
                <div class="form-group">
                    <label for="nomor">Email</label>
                    <input type="email" name="email" class="form-control" style="border:1px solid #f1f1f1;" >
                </div>
                <div class="form-group">
                    <label for="nomor">Password</label>
                    <input type="password" name="password" class="form-control" style="border:1px solid #f1f1f1;" >
                </div>
                <div class="form-group">
                    <label for="nomor">Roles</label>
                    <select name="roles" class="form-control">
                        <option value="">-- Pilih Roles --</option>
                        <option value="kader">Kader Posyandu</option>
                        <option value="orangtua">Orang Tua</option>
                    </select>
                </div>
                {{-- <div class="form-group">
                    <label for="nomor">Foto Thumbnail</label>
                    <input type="file" name="photo" class="form-control">
                </div>
                 --}}
                <button class="btn btn-primary active" style="border-radius:0;">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section("js")
<script>
$(document).ready(function() {
});
</script>
@endsection