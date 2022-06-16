@extends('guru.layout')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h1 class="h3 mb-0 text-gray-800">Jadwal Tahun Akademik
                    {{ $tahun->tahun_1 . ' / ' . $tahun->tahun_2 }}
                    ({{ $tahun->semester == 1 ? 'Ganjil' : 'Genap' }}) </h1>
                <a href="{{ route('guru.listJadwal') }}" class="btn btn-sm btn-dark my-4">Kembali</a>
            </div>
        </div>

        <div class="row">
            @if ($kelas->isEmpty())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Kelas belum ada
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @else
                @foreach ($kelas as $item)
                    <div class="col-md-4 mb-4">
                        <a href="{{ route('guru.detailJadwal', ['tahun' => $tahun->id, 'kelas' => $item->id]) }}"
                            style="text-decoration: none">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                {{ $item->jurusan->nama }}
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                Kelas {{ $item->tingkat . ' / ' . $item->nama }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
