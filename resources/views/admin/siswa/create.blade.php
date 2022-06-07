@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Data Siswa</h1>
        <a href="{{ route('siswa.index') }}" class="btn btn-sm btn-dark mb-4">Kembali</a>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Tambah Siswa Baru
                    </div>
                    <div class="card-body">
                        @if (Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ Session::get('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form action="{{ route('siswa.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                            id="nama_lengkap" aria-describedby="nama_lengkap" placeholder="Nama Lengkap"
                                            name="nama_lengkap">
                                        @error('nama_lengkap')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="nisn">NISN</label>
                                        <input type="text" class="form-control @error('nisn') is-invalid @enderror"
                                            id="nisn" aria-describedby="nisn" placeholder="NISN" name="nisn">
                                        @error('nisn')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                            id="tempat_lahir" aria-describedby="tempat_lahir" placeholder="Tempat Lahir"
                                            name="tempat_lahir">
                                        @error('tempat_lahir')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_lahir">Tanggal Lahir</label>
                                        <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror"
                                            id="tgl_lahir" aria-describedby="tgl_lahir" placeholder="Tanggal Lahir"
                                            name="tgl_lahir">
                                        @error('tgl_lahir')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <label for="tempat_lahir">Jenis Kelamin</label>
                                    <div class="form-row mb-3">
                                        <div class="form-check mr-3">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                id="jenis_kelamin1" value="L" checked>
                                            <label class="form-check-label" for="jenis_kelamin1">
                                                Laki-laki
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                id="jenis_kelamin2" value="P">
                                            <label class="form-check-label" for="jenis_kelamin2">
                                                Perempuan
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_hp">Nomor HP/WA</label>
                                        <input type="number" class="form-control @error('no_hp') is-invalid @enderror"
                                            id="no_hp" aria-describedby="no_hp" placeholder="Nomor HP/WA" name="no_hp">
                                        @error('no_hp')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="kelas">Pilih Kelas</label>
                                        <select class="form-control  @error('kelas_id') is-invalid @enderror"
                                            name="kelas_id" id="kelas">
                                            <option disabled>-- Pilih Kelas --</option>
                                            @foreach ($kelas as $item)
                                                <option value="{{ $item->id }}">{{ $item->tingkat }}
                                                    {{ $item->nama }} /
                                                    {{ $item->jurusan->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kelas_id')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
