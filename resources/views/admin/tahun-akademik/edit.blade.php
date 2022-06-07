@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Data Tahun Akademik</h1>
        <a href="{{ route('kelas.index') }}" class="btn btn-sm btn-dark mb-4">Kembali</a>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Edit Tahun Akademik
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
                        <form action="{{ route('tahun-akademik.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-row align-items-center">
                                <div class="col-5">
                                    <input type="text" class="form-control  @error('tahun_1') is-invalid @enderror"
                                        placeholder="Tahun Awal" name="tahun_1" id="tahun_1" value="{{ $data->tahun_1 }}">
                                    @error('tahun_1')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col text-center">
                                    <h5 class="m-0">/</h5>
                                </div>
                                <div class="col-5">
                                    <input type="text" class="form-control  @error('tahun_2') is-invalid @enderror"
                                        placeholder="Tahun Akhir" name="tahun_2" id="tahun_2" value="{{ $data->tahun_2 }}">
                                    @error('tahun_2')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-group">
                                        <label for="semester">Pilih Semester</label>
                                        <select class="form-control  @error('semester') is-invalid @enderror"
                                            name="semester" id="semester">
                                            <option disabled>-- Pilih Semester --</option>
                                            <option value="1" {{$data->semester == 1 ? 'selected' : ''}}>Ganjil</option>
                                            <option value="2" {{$data->semester == 2 ? 'selected' : ''}}>Genap</option>
                                        </select>
                                        @error('semester')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success mt-3">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
