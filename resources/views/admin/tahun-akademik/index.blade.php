@extends('layouts.main')

@section('pageCss')
    <link rel="stylesheet" href="{{ asset('vendor') }}/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('vendor') }}/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('content')
    <div class="container-fluid" style="min-height: 80vh">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Tahun Akademik</h1>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
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
            </div>
            <div class="col-md-6 mb-3">
                <div class="card shadow rounded">
                    <div class="card-header">
                        <h5 class="m-0 card-title">Tambah Tahun Akademik</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tahun-akademik.store') }}" method="POST">
                            @csrf
                            <div class="form-row align-items-center">
                                <div class="col-5">
                                    <input type="text" class="form-control  @error('tahun_1') is-invalid @enderror"
                                        placeholder="Tahun Awal" name="tahun_1" id="tahun_1">
                                    @error('tahun_1')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col text-center">
                                    <h5 class="m-0">/</h5>
                                </div>
                                <div class="col-5">
                                    <input type="text" class="form-control  @error('tahun_2') is-invalid @enderror"
                                        placeholder="Tahun Akhir" name="tahun_2" id="tahun_2">
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
                                            <option value="1">Ganjil</option>
                                            <option value="2">Genap</option>
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
            <div class="col-md-6">
                <div class="card shadow rounded">
                    <div class="card-header">
                        <h5 class="m-0 card-title">Data Tahun Akademik</h5>
                    </div>
                    <div class="card-body">
                        <table id="table-tahun-akademik" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tahun</th>
                                    <th>Semester</th>
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
    <div class="modal fade" id="delete-tahun-akademik-modal" tabindex="-1" role="dialog"
        aria-labelledby="delete-tahun-akademik-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-tahun-akademik-modal-title">Konfirmasi hapus</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah Anda yakin akan menghapus data?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form method="POST" id="form-delete-tahun-akademik">
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
        $("#table-tahun-akademik").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + "/tahun-akademik",
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
                    data: "smt",
                    name: "smt",
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

        $("#table-tahun-akademik").on("click", ".delete-tahun-akademik", function() {
            var id = $(this).attr("data-id");
            $("#form-delete-tahun-akademik").attr(
                "action",
                `${APP_URL}/tahun-akademik/${id}`
            );
        });
    </script>
@endsection
