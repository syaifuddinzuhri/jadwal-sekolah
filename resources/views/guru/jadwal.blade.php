@extends('guru.layout')

@section('content')
    <div class="container my-5">
        <div class="row">
            @if ($tahun->isEmpty())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Tahun akademik belum ada
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @else
                @foreach ($tahun as $item)
                    <div class="col-md-6 mb-4">
                        <a href="{{ route('guru.listJadwal', ['tahun' => $item->id]) }}" style="text-decoration: none">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Tahun Akademik</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $item->tahun_1 . ' / ' . $item->tahun_2 }}
                                                ({{ $item->semester == 1 ? 'Ganjil' : 'Genap' }})
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
