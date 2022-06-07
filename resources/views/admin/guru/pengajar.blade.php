@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Data Guru</h1>
        <a href="{{ route('guru.index') }}" class="btn btn-sm btn-dark mb-4">Kembali</a>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Update Mata Pelajaran
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tahun_akademik">Pilih Tahun Akademik</label>
                                    <select class="form-control  @error('tahun_akademik_id') is-invalid @enderror"
                                        name="tahun_akademik_id" id="tahun_akademik"
                                        onchange="selectTahun({{ $data_guru->id }}, this.options[this.selectedIndex].value)">
                                        <option disabled>-- Pilih Tahun Akademik --</option>
                                        @foreach ($all_tahun as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $tahun ? ($tahun->id == $item->id ? 'selected' : '') : '' }}>
                                                {{ $item->tahun_1 . ' / ' . $item->tahun_2 . ' (' . $item->semester . ')' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tahun_akademik_id')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @if ($tahun)
                            <form action="{{ route('guru.simpanmapel') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <input type="hidden" name="id" value="{{ $data_guru->id }}">
                                    @if (count($mapel) > 0)
                                        @foreach ($mapel as $item)
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $item->id }}" name="mapels[]"
                                                        id="{{ 'mapel' . $item->id }}">
                                                    <label class="form-check-label" for="{{ 'mapel' . $item->id }}">
                                                        <span
                                                            class="font-weight-bold">{{ $item->kode_mapel . ' / ' . $item->nama_mapel }}</span>
                                                        <br>
                                                        {{ $item->kelas->tingkat . ' ' . $item->kelas->nama . ' / ' . $item->kelas->jurusan->nama }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            Mata Pelajaran belum ada
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </form>
                        @else
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Tahun Akademik tidak ditemukan
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Data Mata Pelajaran
                    </div>
                    <div class="card-body">
                        @if ($mapels->isEmpty())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Belum ada mata pelajaran
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @else
                            @php
                                $no = 1;
                            @endphp
                            <ul class="list-group" id="listmapel">
                                @foreach ($mapels as $item)
                                    <li class="row">
                                        <div class="col-10">
                                            <span
                                                class="font-weight-bold">{{ $no . '. ' . $item->mapel->kode_mapel . ' / ' . $item->mapel->nama_mapel }}</span>
                                            <br>
                                            {{ $item->mapel->kelas->tingkat . ' ' . $item->mapel->kelas->nama . ' / ' . $item->mapel->kelas->jurusan->nama }}
                                        </div>
                                        <div class="col-2">
                                            <a href="javascript:void(0)" data-id="{{ $item->id }}" data-toggle="modal"
                                                data-target="#delete-mapelguru-modal"
                                                class="btn btn-sm btn-danger delete-mapelguru">
                                                <i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                    </li>
                                    <hr>
                                    @php
                                        $no++;
                                    @endphp
                                @endforeach
                            </ul>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modalPage')
    {{-- Delete Modal --}}
    <div class="modal fade" id="delete-mapelguru-modal" tabindex="-1" role="dialog"
        aria-labelledby="delete-mapelguru-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-mapelguru-modal-title">Konfirmasi hapus</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah Anda yakin akan menghapus data?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form method="POST" id="form-delete-mapelguru">
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
        function selectTahun(id, tahun) {
            window.location.href = APP_URL + '/guru/pengajar/' + id + '?tahun=' + tahun
        }

        $("#listmapel").on("click", ".delete-mapelguru", function() {
            var id = $(this).attr("data-id");
            $("#form-delete-mapelguru").attr(
                "action",
                `${APP_URL}/guru/pengajar/delete/${id}`
            );
        });
    </script>
@endsection
