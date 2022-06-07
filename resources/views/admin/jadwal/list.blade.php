@extends('layouts.main')

@section('content')
    <div class="container-fluid" style="min-height: 80vh">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Jadwal Kelas
                {{ $kelas->tingkat . ' / ' . $kelas->nama . ' ' . $kelas->jurusan->nama }} | Tahun Akademik
                {{ $tahun->tahun_1 . ' / ' . $tahun->tahun_2 }}
                ({{ $tahun->semester == 1 ? 'Ganjil' : 'Genap' }}) </h1>
        </div>
        <a href="{{ route('jadwal.index', ['tahun' => $tahun->id]) }}" class="btn btn-sm btn-dark mb-4">Kembali</a>

        <div class="row">
            @foreach ($days as $item)
                <div class="col-md-6 mb-3">
                    <ul class="list-group">
                        <li class="list-group-item active" aria-current="true">
                            <a href="{{ route('jadwal.create', ['tahun' => $tahun->id, 'kelas' => $kelas->id, 'day' => $item->id]) }}"
                                class="btn btn-sm btn-light mr-2">
                                <i class="fa fa-plus" aria-hidden="true"></i> </a>
                            {{ $item->nama }}
                        </li>
                        @foreach ($jadwal as $j)
                            @if ($j->day_id == $item->id)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-2 col-3">
                                            <small class="font-weight-bold">{{ '(' . $j->mapel->kode_mapel . ')' }}</small>
                                        </div>
                                        <div class="col-md-6 col-9">
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
                                        <div class="col-md-2 col-6 text-right">
                                            {{-- <a href="" class="btn btn-sm btn-warning">
                                                <i class="fa fa-edit" aria-hidden="true"></i> </a> --}}
                                            <a href="javascript:void(0)" data-toggle="modal"
                                                data-target="#delete-jadwal-modal"
                                                onclick="handleDelete({{ $j->id }})"
                                                class="btn btn-sm btn-danger delete-jadwal">
                                                <i class="fa fa-trash" aria-hidden="true"></i></a>
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

@section('modalPage')
    {{-- Delete Modal --}}
    <div class="modal fade" id="delete-jadwal-modal" tabindex="-1" role="dialog"
        aria-labelledby="delete-jadwal-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-jadwal-modal-title">Konfirmasi hapus</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah Anda yakin akan menghapus data?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form method="POST" id="form-delete-jadwal">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-submit">
                            <i class="fas fa-fw fa-trash"></i>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pageScript')
    <script>
        function handleDelete(id) {
            $("#form-delete-jadwal").attr(
                "action",
                `${APP_URL}/jadwal/${id}`
            );
        }
    </script>
@endsection
