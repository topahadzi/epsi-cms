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
<div class="col-lg-12 col-sm-12">
    <div class="card">
        <div class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="icon-big icon-danger text-center">
                        <button class="btn btn-primary active" style="border-radius:0;" data-toggle="modal" data-target="#add"><i class="fas fa-qrcode"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4 col-sm-6">
    <div class="card">
        <div class="content">
            <div class="row">
                <div class="col-xs-5">
                    <div class="icon-big icon-danger text-center">
                        <i class="fas fa-book"></i>
                    </div>
                </div>
                <div class="col-xs-7">
                    <div class="numbers">
                        <p>Posyandu</p>
                        {{-- {{ $data->kereta }} --}}
                    </div>
                </div>
            </div>
            <div class="footer text-right">
                <hr />
                {{-- <a href="{{ route('kereta') }}">Details</a> --}}
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4 col-sm-6">
    <div class="card">
        <div class="content">
            <div class="row">
                <div class="col-xs-5">
                    <div class="icon-big icon-success text-center">
                        <i class="fas fa-book"></i>
                    </div>
                </div>
                <div class="col-xs-7">
                    <div class="numbers">
                        <p>Jumlah Orang Tua</p>
                        {{-- {{ $data->laporan }} --}}
                    </div>
                </div>
            </div>
            <div class="footer text-right">
                <hr />
                {{-- <a href="{{ route('laporan') }}">Details</a> --}}
            </div>
        </div>
    </div>
</div>
@endsection


@section("modal")
<!-- Tambah Modal -->
<div class="modal" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">QR</h4>
            </div>

            <!-- Modal body -->
            <form action="{{ url('/kereta') }}" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="form-group">
                    
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            </form>

        </div>
    </div>
</div>
@endsection
