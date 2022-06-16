@extends('guru.layout')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h1 class="h3 mb-0 text-gray-800">Jadwal Kelas
                    {{ $kelas->tingkat . ' / ' . $kelas->nama . ' ' . $kelas->jurusan->nama }} | Tahun Akademik
                    {{ $tahun->tahun_1 . ' / ' . $tahun->tahun_2 }}
                    ({{ $tahun->semester == 1 ? 'Ganjil' : 'Genap' }}) </h1>
                <a href="{{ route('guru.listJadwal', ['tahun' => $tahun->id]) }}" class="btn btn-sm btn-dark my-4">Kembali</a>
            </div>
        </div>
        <div class="row">
            @foreach ($days as $item)
                <div class="col-md-6 mb-3">
                    <ul class="list-group">
                        <li class="list-group-item active" aria-current="true">
                            {{ $item->nama }}
                        </li>
                        @foreach ($jadwal as $j)
                            @if ($j->day_id == $item->id)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-2 col-3">
                                            <small
                                                class="font-weight-bold">{{ '(' . $j->mapel->kode_mapel . ')' }}</small>
                                        </div>
                                        <div class="col-md-8 col-9">
                                            <span class="text-dark font-weight-bold">{{ $j->mapel->nama_mapel }}
                                                <br></span>
                                            @if ($j->mapel->pengajars->isNotEmpty())
                                                <span
                                                    class="font-italic">{{ $j->mapel->pengajars[0]->nama . ',' . $j->mapel->pengajars[0]->gelar }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-2 col-6">
                                            <small>{{ date('H:i', strtotime($j->mapel->start)) . ' - ' . date('H:i', strtotime($j->mapel->end)) }}</small>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
@endsection
