<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="SMAN 1 TUREN JL. MAYJEN. PANJAITAN NO. 65 TUREN, Sedayu, Kec. Turen, Kab. Malang Prov. Jawa Timur">
    <meta name="author" content="SMAN 1 TUREN MALANG">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <title>SMAN 1 Turen Malang</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('templates') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('templates') }}/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <a class="navbar-brand" href="{{ route('guru.home') }}">
                    <img src="{{ asset('images/logo.png') }}" width="30" height="30" class="d-inline-block align-top"
                        alt="">
                    SMAN 1 Turen
                </a>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('guru.home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('guru.listJadwal') }}">Jadwal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row my-3">
            <div class="col-12">
                <h6 class="text-dark m-0">Nama : {{ Auth::guard('guru')->user()->nama }} | Email :
                    {{ Auth::guard('guru')->user()->email }}</h6>
            </div>
        </div>
    </div>
    <hr>
    @yield('content')


    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Anda yakin mau keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Klik "Logout" dibawah jika kamu ingin keluar dari sistem.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
                    <form action="{{ route('auth.gurulogout') }}" method="POST">
                        @csrf
                        <button class="btn btn-danger">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('templates') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('templates') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('templates') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('templates') }}/js/sb-admin-2.min.js"></script>

</body>

</html>
