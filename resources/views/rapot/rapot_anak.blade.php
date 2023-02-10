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
                <h4 class="title"><b>Data Anak</b></h4>
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
                    <th>Umur</th>
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

    $.ajax({
        url: "{{config('app.api_url')}}"+"posyandu/orangtua/{{session()->get('posyandu_id')}}",
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer {{session()->get("token_user")}}');
        },
        success: function (res) {
            let filteredData =  res.orangtua.filter(ortu => ortu._id == "{{$id_orangtua}}" );
            let dataMaster = [];

            for (let i = 0; i < filteredData[0].anak.length; i++) {
                dataMaster.push(filteredData[0].anak[i]);
            }

            $('#table').DataTable().clear().rows.add(dataMaster).draw();


         }
    });  

    $('#table').DataTable({
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
                "mData": "umur",
                "mRender": function (data, type, row, meta) {
                    return data ? data : '';
                }
            },
            {
                "mData": "_id",
                "mRender": function (data, type, row) {
                    let detail = `{{ url('/rapot_anak_list/${data}') }}`;
                    return `<a href="${detail}" id="list_anak" class="btn btn-success active" style="border-radius:0;"><i class="fas fa-list"></i></a>`;
                }
            }
        ]
    });

});



// Confirmation
$(document).on('click', '.delete-data',function(e){
    e.preventDefault();
    let id = $(this).data('id');
    $.ajax({
        url: `{{config('app.api_url')}}berita/${id}`,
        type: 'DELETE',
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer {{session()->get("token_user")}}');
        },
        success: function(result) {
            $('#table').DataTable().ajax.reload();
            swal("Berhasil", "Berhasil Menghapus Data", "success");
        },
        fail: function(xhr, textStatus, errorThrown){
            swal("Gagal", "Gagal Menghapus Data", "error");
        }
    });
});
</script>
@endsection