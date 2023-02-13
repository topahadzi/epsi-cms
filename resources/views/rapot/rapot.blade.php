@extends("layouts/master")

@section("title","Rapot Anak")

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
    <li class="active">
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
                <h4 class="title"><b>Data Orang Tua</b></h4>
            </div>
            <div class="col-lg-2">
                {{-- <a href="{{route('berita_tambah')}}">
                    <button class="btn btn-primary active" style="border-radius:0;">Tambah <i class="fas fa-plus"></i></button>
                </a> --}}
            </div>
        </div>
        <div class="content table-responsive table-full-width">
            <table id="table" class="table table-striped">
                <thead>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Nik</th>
                    <th>Alamat</th>
                    <th width="30%">Aksi</th>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@section("js")
<script>
$(document).ready(function() {
    if ("{{session()->get('roles')}}" == "admin") {
        $('#table').DataTable();
    } else {
        $('#table').DataTable({
            ajax: {
                url: "{{config('app.api_url')}}"+"posyandu/orangtua/{{session()->get('posyandu_id')}}",
                type: "GET",
                dataSrc: 'orangtua',
                dataType: 'json',
                contentType: "application/json",
                headers: {
                    "Authorization": "Bearer {{session()->get('token_user')}}",
                },
            },
            columns: [
                {
                    "mData": "_id",
                    "mRender": function (data, type, row, meta) {
                        return meta['row'] + 1;
                    }
                },
                {
                    "mData": "name",
                    "mRender": function (data, type, row, meta) {
                        return data ? data : '';
                    }
                },
                {
                    "mData": "nik",
                    "mRender": function (data, type, row, meta) {
                        return data ? data : '';
                    }
                },
                {
                    "mData": "alamat",
                    "mRender": function (data, type, row, meta) {
                        return data ? data : '';
                    }
                },
                {
                    "mData": "_id",
                    "mRender": function (data, type, row) {
                        let detail = `{{ url('/rapot_anak/${data}') }}`;
                        return `<a href="${detail}"  id="list_anak" class="btn btn-success active" style="border-radius:0;"><i class="fas fa-list"></i></a>`;
                    }
                }
            ]
        });
    }
});

</script>
@endsection