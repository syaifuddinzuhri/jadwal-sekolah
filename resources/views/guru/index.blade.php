@extends('guru.layout')

@section('content')
    <div class="container my-5">
        <div class="jumbotron jumbotron-fluid bg-white">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="display-5 text-dark">Selamat Datang <br> {{ Auth::guard('guru')->user()->nama }}</h1>
                        <p class="lead">Aplikasi jadwal sekolah SMAN 1 Turen Malang</p>
                    </div>
                    <div class="col-md-4">
                        <img src="https://media.istockphoto.com/vectors/business-planning-concept-scheduling-time-management-setting-priority-vector-id1217549247?b=1&k=20&m=1217549247&s=612x612&w=0&h=asBfJhZFwtts43SDOJ8PT8l8z5aXCnh1kXUcSbwgKlE="
                            alt="" class="w-100">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
