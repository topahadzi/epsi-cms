<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/img/apple-icon.png') }}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('/img/favicon.png') }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>@yield("title")</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- Animation library for notifications   -->
    <link href="{{ asset('/css/animate.min.css') }}" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="{{ asset('/css/paper-dashboard.css') }}" rel="stylesheet"/>

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link href="{{ asset('/css/themify-icons.css') }}" rel="stylesheet">

    <!-- Syncfusion Bootstrap Style -->
    <link rel="stylesheet" href="https://cdn.syncfusion.com/ej2/bootstrap.css" />

    <!-- DataTables Style -->
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet">

    <style>
    .swal2-popup {
        font-size: 1.6rem !important;
    }
    .swal2-icon {
        width: 5em !important;
        height: 5em !important;
        border-width: .25em !important;
    }
    form{
        display: inline;
    }
    </style>
    @yield("css")

</head>
<body>

<div class="wrapper">
	<div class="sidebar" data-background-color="white" data-active-color="info">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{ route('main') }}" class="simple-text">
                    EPSI
                </a>
            </div>

            <ul class="nav">
                <!-- Link dipanggil dengan fungsi route sesuai nama dari route nya (web.php)  -->
                @section("sidebar")
                <li class="active">
                    {{-- <a href="{{ route('main') }}"> --}}
                        <i class="ti-home"></i>
                        <p>Dashboard</p>
                    {{-- </a> --}}
                </li>
                @show
            </ul>
    	</div>
    </div>

    <div class="main-panel">
		<nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                            <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">@yield("title")</a>
                </div>
                @section("topbar")
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#">
                                <p>{{session()->get('name')}}</p>
                            </a>
                        </li>
						<li>
                            <a href="{{ url('/logout') }}">
								<i class="fas fa-sign-out-alt"></i>
								<p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </div>
                @show
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @yield("content")
                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
				<div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by EPSI
                </div>
            </div>
        </footer>

    </div>
</div>


</body>
@yield("modal");
    <!--   Core JS Files   -->
    <script src="{{ asset('/js/jquery-1.10.2.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="{{ asset('/js/bootstrap-checkbox-radio.js') }}"></script>

	<!--  Charts Plugin -->
	<script src="{{ asset('/js/chartist.min.js') }}"></script>

    <!--  Notifications Plugin -->
    <script src="{{ asset('/js/bootstrap-notify.js') }}"></script>
    <script src="{{ asset('/js/sweetalert2.all.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

    <!--  DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <!-- Bootstrap 3 DataTables -->
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <!-- Syncfusion JS -->
    <script src="https://cdn.syncfusion.com/ej2/dist/ej2.min.js" type="text/javascript"></script>

    <!-- CKEditor -->
	<script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>

    <script>
    

    // Notification
    @if(session()->has('success'))
    swal({
    type: 'success',
    title: 'Success',
    text: 'Berhasil {{ session()->get("success") }}' 
    })
    @elseif(session()->has('error'))
    swal({
    type: 'error',
    title: 'Oops...',
    text: 'Gagal {{ session()->get("error") }}'
    })
    @endif
    </script>

    @yield("js")

</html>
