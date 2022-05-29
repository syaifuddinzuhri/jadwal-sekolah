@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Data Mata Pelajaran</h1>
        <a href="{{ route('mapel.index') }}" class="btn btn-sm btn-dark mb-4">Kembali</a>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Edit Mata Pelajaran
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
                        <form action="{{ route('mapel.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="tahun_akademik">Pilih Tahun Akademik</label>
                                <select class="form-control  @error('tahun_akademik_id') is-invalid @enderror"
                                    name="tahun_akademik_id" id="tahun_akademik">
                                    <option disabled>-- Pilih Tahun Akademik --</option>
                                    @foreach ($tahun as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $data->tahun_akademik_id ? 'selected' : '' }}>
                                            {{ $item->tahun_1 }} / {{ $item->tahun_2 }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tahun_akademik_id')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kelas">Pilih Kelas</label>
                                <select class="form-control  @error('kelas_id') is-invalid @enderror" name="kelas_id"
                                    id="kelas">
                                    <option disabled>-- Pilih Kelas --</option>
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $data->kelas_id ? 'selected' : '' }}>
                                            {{ $item->tingkat }} {{ $item->nama }} /
                                            {{ $item->jurusan->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kelas_id')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kode_mapel">Kode Mata Pelajaran</label>
                                <input type="text" class="form-control @error('kode_mapel') is-invalid @enderror"
                                    id="kode_mapel" aria-describedby="kode_mapel" placeholder="Kode mata pelajaran"
                                    name="kode_mapel" value="{{ $data->kode_mapel }}">
                                @error('kode_mapel')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama_mapel">Nama Mata Pelajaran</label>
                                <input type="text" class="form-control @error('nama_mapel') is-invalid @enderror"
                                    id="nama_mapel" aria-describedby="nama_mapel" placeholder="Nama mata pelajaran"
                                    name="nama_mapel" value="{{ $data->nama_mapel }}">
                                @error('nama_mapel')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="total_jam">Total Jam/hari</label>
                                <input type="number" class="form-control @error('total_jam') is-invalid @enderror"
                                    id="total_jam" aria-describedby="total_jam" placeholder="Total jam pelajaran/hari"
                                    name="total_jam" value="{{ $data->total_jam }}">
                                @error('total_jam')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-row mb-3">
                                <div class="col">
                                    <label for="start">Jam Mulai</label>
                                    <input type="time" class="form-control @error('start') is-invalid @enderror" id="start"
                                        aria-describedby="start" name="start" value="{{ $data->start }}">
                                    @error('start')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="end">Jam Selesai</label>
                                    <input type="time" class="form-control @error('end') is-invalid @enderror" id="end"
                                        aria-describedby="end" name="end" value="{{ $data->end }}">
                                    @error('end')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
