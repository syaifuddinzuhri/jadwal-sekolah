@extends('layouts.main')

@section('pageCss')
    <link rel="stylesheet" href="{{ asset('vendor') }}/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('vendor') }}/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('content')
    <div class="container-fluid" style="min-height: 80vh">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Mata Pelajaran</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{ route('mapel.create') }}" class="btn btn-primary mb-4"><i class="fas fa-plus mr-2"></i>Tambah
                    Mata Pelajaran</a>
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
                <div class="card shadow rounded">
                    <div class="card-header">
                        <h5 class="m-0 card-title">Data Mata Pelajaran</h5>
                    </div>
                    <div class="card-body">
                        <table id="table-mapel" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tahun Akademik</th>
                                    <th>Kode Mapel</th>
                                    <th>Nama Mapel</th>
                                    <th>Total Jam/hari</th>
                                    <th>Waktu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modalPage')
    {{-- Delete Modal --}}
    <div class="modal fade" id="delete-mapel-modal" tabindex="-1" role="dialog"
        aria-labelledby="delete-mapel-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-mapel-modal-title">Konfirmasi hapus</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah Anda yakin akan menghapus data?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form method="POST" id="form-delete-mapel">
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
    <script src="{{ asset('vendor') }}/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('vendor') }}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('vendor') }}/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('vendor') }}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

    <script>
        // DATATABLES
        $("#table-mapel").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + "/mapel",
            },
            columns: [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    className: "text-center",
                    width: "4%",
                },
                {
                    data: "tahun",
                    name: "tahun",
                },
                {
                    data: "kode_mapel",
                    name: "kode_mapel",
                },
                {
                    data: "nama_mapel",
                    name: "nama_mapel",
                },
                {
                    data: "total_jam",
                    name: "total_jam",
                },
                {
                    data: "waktu",
                    name: "waktu",
                },
                {
                    data: "action",
                    name: "action",
                    className: "text-center",
                    orderable: false,
                    searchable: false,
                },
            ],
        });

        $("#table-mapel").on("click", ".delete-mapel", function() {
            var id = $(this).attr("data-id");
            $("#form-delete-mapel").attr(
                "action",
                `${APP_URL}/mapel/${id}`
            );
        });
    </script>
@endsection
