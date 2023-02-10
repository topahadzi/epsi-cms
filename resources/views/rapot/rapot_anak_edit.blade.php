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
            <div class="col-lg-8">
                <h4 class="title"><b>Perbarui Rapot Anak</b></h4>
            </div>
            <div class="col-lg-4">
                <h4 class="title nama_anak_title" style="text-align: right;"></h4>
            </div>
        </div>
        <hr/>
        <div class="col-xs-12">
            <form action="{{ url('/rapot_anak_edit/update') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="nomor">Nama Rapor</label>
                        <input type="text" id="name_view" disabled class="form-control" style="border:1px solid #f1f1f1;" >
                        <input type="hidden" name="name" id="name" class="form-control" style="border:1px solid #f1f1f1;" >
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label for="nomor">Tinggi Badan ( cm )</label>
                        <input type="number" id="tinggi_badan" name="tinggi_badan" class="form-control" style="border:1px solid #f1f1f1;" required>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label for="nomor">Berat Badan ( kg )</label>
                        <input type="number" id="berat_badan" name="berat_badan" class="form-control" style="border:1px solid #f1f1f1;" required>
                    </div>
                </div>
                {{-- <div class="col-xs-4">
                    <div class="form-group">
                        <label for="nomor">Umur</label>
                        <input type="text" id="umur" class="form-control" style="border:1px solid #f1f1f1;" name="title">
                    </div>
                </div> --}}
                <div class="col-xs-2">
                    <div class="form-group">
                        <label for="nomor">Hepatitis A</label>
                        <input type="checkbox" id="hepatitis_a" name="hepatitis_a">
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="form-group">
                        <label for="nomor">Hepatitis B</label>
                        <input type="checkbox" id="hepatitis_b" name="hepatitis_b">
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="form-group">
                        <label>Polio</label>
                        <input type="checkbox" id="polio" name="polio">
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="form-group">
                        <label>BCG</label>
                        <input type="checkbox" id="bcg" name="bcg">
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="form-group">
                        <label>DTP</label>
                        <input type="checkbox" id="dtp" name="dtp">
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="form-group">
                        <label>HIB</label>
                        <input type="checkbox" id="hib" name="hib">
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="form-group">
                        <label>PCV</label>
                        <input type="checkbox" id="pcv" name="pcv">
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="form-group">
                        <label>Rotavirus</label>
                        <input type="checkbox" id="rotavirus" name="rotavirus">
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="form-group">
                        <label>Influenza</label>
                        <input type="checkbox" id="influenza" name="influenza">
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="form-group">
                        <label>MR</label>
                        <input type="checkbox" id="mr" name="mr">
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="form-group">
                        <label>JE</label>
                        <input type="checkbox" id="je" name="je">
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="form-group">
                        <label>Varisela</label>
                        <input type="checkbox" id="varisela" name="varisela">
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="form-group">
                        <label>Tifoid</label>
                        <input type="checkbox" id="tifoid" name="tifoid">
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="form-group">
                        <label>Dengue</label>
                        <input type="checkbox" id="dengue" name="dengue">
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="hidden" name="anak" value="{{$id_anak}}">
                        <input type="hidden" id="tgl_lahir" name="tgl_lahir">
                        <input type="hidden" id="bulan" name="bulan">
                        <input type="hidden" id="id_rapor" name="id_rapor" value="{{$id_rapor}}">
                        <button class="btn btn-info active" style="border-radius:0;">Perbarui</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section("js")
<script>
$(document).ready(function() {

    $('.icons').remove();

    $.ajax({
        url: "{{config('app.api_url')}}"+"rapor/anak/{{$id_anak}}",
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer {{session()->get("token_user")}}');
        },
        success: function (res) {
            console.log(res);
            let nama = `Raport ${res.rapor.length + 1} Bulan`;
            $('#name_view').val(nama);
            $('#name').val(nama);
            $('#bulan').val(res.rapor.length + 1);

            let newestRapor = res.rapor.filter(function (rpr) {
                return rpr._id == "{{$id_rapor}}";
            });
            let imunisasi = newestRapor[0].imunisasi[0];
            $('#tinggi_badan').val(newestRapor[0].tinggi_badan);
            $('#berat_badan').val(newestRapor[0].berat_badan);
            $('#hepatitis_a').prop( "checked", imunisasi.hepatitis_a);
            $('#hepatitis_b').prop( "checked", imunisasi.hepatitis_b);
            $('#bcg').prop( "checked", imunisasi.bcg);
            $('#dengue').prop( "checked", imunisasi.dengue);
            $('#dtp').prop( "checked", imunisasi.dtp);
            $('#hib').prop( "checked", imunisasi.hib);
            $('#influenza').prop( "checked", imunisasi.influenza);
            $('#je').prop( "checked", imunisasi.je);
            $('#mr').prop( "checked", imunisasi.mr);
            $('#pcv').prop( "checked", imunisasi.pcv);
            $('#polio').prop( "checked", imunisasi.polio);
            $('#rotavirus').prop( "checked", imunisasi.rotavirus);
            $('#tifoid').prop( "checked", imunisasi.tifoid);
            $('#varisela').prop( "checked", imunisasi.varisela);
         }
    });  
    
    $.ajax({
        url: "{{config('app.api_url')}}"+"anak/{{$id_anak}}",
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer {{session()->get("token_user")}}');
        },
        success: function (res) {
            $('#tgl_lahir').val(res.anak.tanggal_lahir);
            $('.nama_anak_title').append(`${res.anak.name}`)
         }
    });  
});
</script>
@endsection