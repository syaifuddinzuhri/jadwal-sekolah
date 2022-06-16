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

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-12 col-md-8">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="{{ asset('images/logo.png') }}" alt="logo" width="25%">
                                        <h1 class="font-weight-bold text-gray-900 mt-4">LOGIN</h1>
                                        <h1 class="h5 text-gray-900 mt-2 mb-4">JADWAL PELAJARAN SMAN 1 TUREN MALANG</h1>
                                    </div>
                                    @if (Session::has('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ Session::get('error') }}
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    @if (Session::has('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ Session::get('success') }}
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <form class="user" method="POST" action="{{ route('auth.login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email"
                                                class="form-control  @error('email') is-invalid @enderror"
                                                id="email" aria-describedby="emailHelp" placeholder="Email"
                                                name="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password"
                                                class="form-control  @error('password') is-invalid @enderror"
                                                id="password" placeholder="Password" name="password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <select
                                                class="form-control @error('role') is-invalid @enderror"
                                                name="role" id="role">
                                                <option disabled>-- Pilih Role --</option>
                                                <option value="admin">Admin</option>
                                                <option value="guru">Guru</option>
                                            </select>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    {{-- <hr> --}}
                                    {{-- <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div> --}}
                                    {{-- <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
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
