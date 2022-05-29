@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Data Kelas</h1>
        <a href="{{ route('kelas.index') }}" class="btn btn-sm btn-dark mb-4">Kembali</a>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Tambah Kelas Baru
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
                        <form action="{{ route('kelas.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="jurusan">Pilih Jurusan</label>
                                <select class="form-control  @error('jurusan_id') is-invalid @enderror" name="jurusan_id"
                                    id="jurusan">
                                    <option disabled>-- Pilih Jurusan --</option>
                                    @foreach ($jurusan as $item)
                                        <option value="{{ $item->id }}">{{ $item->kode }} - {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jurusan_id')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kode">Tingkat</label>
                                <select class="form-control  @error('tingkat') is-invalid @enderror" name="tingkat"
                                    id="jurusan">
                                    <option disabled>-- Pilih Tingkat --</option>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XI</option>
                                </select>
                                @error('tingkat')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kode">Nama kelas</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                    aria-describedby="nama" placeholder="Nama kelas" name="nama">
                                <small id="emailHelp" class="form-text text-muted">Contoh: A, B, dll</small>
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
