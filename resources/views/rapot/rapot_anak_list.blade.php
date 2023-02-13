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
            <i class="fas fa-newspaper"></i>
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
                <h4 class="title nama_anak_title"></h4>
            </div>
            <div class="col-lg-2">
                <a href='{{url("/rapot_anak_add/$id_anak")}}'>
                    <button class="btn btn-primary active" style="border-radius:0;">Tambah <i class="fas fa-plus"></i></button>
                </a>
            </div>
        </div>
        <div class="content table-responsive table-full-width">
            <table id="table" class="table table-striped">
                <thead>
                    <th>#</th>
                    <th>Nama</th>
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
    $('#table').DataTable({
        ajax: {
            url: "{{config('app.api_url')}}"+"rapor/anak/{{$id_anak}}",
            type: "GET",
            dataSrc: 'rapor',
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
                "mData": "_id",
                "mRender": function (data, type, row) {
                    let detail = `{{ url("/rapot_anak_edit/$id_anak") }}` + `/${data}`;
                    return `<a href="${detail}" id="list_anak" class="btn btn-warning active" style="border-radius:0;"><i class="fas fa-pencil-alt"></i></a>`;
                }
            }
        ]
    });

    $.ajax({
        url: "{{config('app.api_url')}}"+"anak/{{$id_anak}}",
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer {{session()->get("token_user")}}');
        },
        success: function (res) {
            $('.nama_anak_title').append(`<b>Data Rapot Anak ${res.anak.name}</b>`)
         }
    });  
});



</script>
@endsection