@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Jadwal Kelas
                {{ $kelas->tingkat . ' / ' . $kelas->nama . ' ' . $kelas->jurusan->nama }} | Tahun Akademik
                {{ $tahun->tahun_1 . ' / ' . $tahun->tahun_2 }}
                ({{ $tahun->semester == 1 ? 'Ganjil' : 'Genap' }}) </h1>
        </div>
        <a href="{{ route('jadwal.list', ['tahun' => $tahun->id, 'kelas' => $kelas->id]) }}"
            class="btn btn-sm btn-dark mb-4">Kembali</a>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Tambah Jadwal Pelajaran <span class="font-weight-bold">[{{ $day->nama }}]</span>
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
                        <form action="{{ route('jadwal.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
                            <input type="hidden" name="tahun_akademik_id" value="{{ $tahun->id }}">
                            <input type="hidden" name="day_id" value="{{ $day->id }}">
                            <div class="form-group">
                                <label for="mata_pelajaran">Pilih Mata Pelajaran</label>
                                <select class="form-control  @error('mata_pelajaran_id') is-invalid @enderror"
                                    name="mata_pelajaran_id" id="mata_pelajaran">
                                    <option disabled>-- Pilih Mata Pelajaran --</option>
                                    @foreach ($mapels as $item)
                                        <option value="{{ $item->id }}">{{ $item->kode_mapel }} -
                                            {{ $item->nama_mapel }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('mata_pelajaran_id')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="urutan">Urutan</label>
                                <input type="number" class="form-control @error('urutan') is-invalid @enderror" id="urutan"
                                    aria-describedby="urutan" placeholder="Urutan" name="urutan">
                                @error('urutan')
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
