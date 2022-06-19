@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Data Guru</h1>
        <a href="{{ route('guru.index') }}" class="btn btn-sm btn-dark mb-4">Kembali</a>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Edit Data Guru
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
                        <form action="{{ route('guru.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" aria-describedby="nama" placeholder="Nama" name="nama"
                                            value="{{ $data->nama }}">
                                        @error('nama')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="gelar">Gelar</label>
                                        <input type="text" class="form-control @error('gelar') is-invalid @enderror"
                                            id="gelar" aria-describedby="gelar" placeholder="Gelar" name="gelar"
                                            value="{{ $data->gelar }}">
                                        <small id="emailHelp" class="form-text text-muted">Contoh: S.Pd atau boleh
                                            dikosongi</small>
                                        @error('gelar')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="pendidikan">Pendidikan</label>
                                        <input type="text" class="form-control @error('pendidikan') is-invalid @enderror"
                                            id="pendidikan" aria-describedby="pendidikan" placeholder="Pendidikan"
                                            name="pendidikan" value="{{ $data->pendidikan }}">
                                        @error('pendidikan')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="nip">NIP</label>
                                        <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                            id="nip" aria-describedby="nip" placeholder="NIP" name="nip"
                                            value="{{ $data->nip }}">
                                        @error('nip')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="nuptk">NUPTK</label>
                                        <input type="text" class="form-control @error('nuptk') is-invalid @enderror"
                                            id="nuptk" aria-describedby="nuptk" placeholder="NUPTK" name="nuptk"
                                            value="{{ $data->nuptk }}">
                                        @error('nuptk')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        <input type="text"
                                            class="form-control @error('tempat_lahir') is-invalid @enderror"
                                            id="tempat_lahir" aria-describedby="tempat_lahir" placeholder="Tempat Lahir"
                                            name="tempat_lahir" value="{{ $data->tempat_lahir }}">
                                        @error('tempat_lahir')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_lahir">Tanggal Lahir</label>
                                        <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror"
                                            id="tgl_lahir" aria-describedby="tgl_lahir" placeholder="Tanggal Lahir"
                                            name="tgl_lahir" value="{{ date('Y-m-d', strtotime($data->tgl_lahir)) }}">
                                        @error('tgl_lahir')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" aria-describedby="email" placeholder="Email" name="email"
                                            value="{{ $data->email }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            aria-describedby="password" placeholder="Password" name="password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_hp">Nomor HP/WA</label>
                                        <input type="number" class="form-control @error('no_hp') is-invalid @enderror"
                                            id="no_hp" aria-describedby="no_hp" placeholder="Nomor HP/WA"
                                            name="no_hp" value="{{ $data->no_hp }}">
                                        @error('no_hp')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat Lengkap</label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3"
                                            placeholder="Nama Jalan, Nomor Rumah, Dusun, RT/RW">{{ $data->alamat }}</textarea>
                                        @error('alamat')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="provinsi">Provinsi</label>
                                        <input type="text"
                                            class="form-control @error('provinsi') is-invalid @enderror" id="provinsi"
                                            aria-describedby="provinsi" placeholder="Provinsi" name="provinsi"
                                            value="{{ $data->provinsi }}">
                                        @error('provinsi')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="kab_kota">Kabupaten/Kota</label>
                                        <input type="text"
                                            class="form-control @error('kab_kota') is-invalid @enderror" id="kab_kota"
                                            aria-describedby="kab_kota" placeholder="Kabupaten/Kota" name="kab_kota"
                                            value="{{ $data->kab_kota }}">
                                        @error('kab_kota')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="kecamatan">Kecamatan</label>
                                        <input type="text"
                                            class="form-control @error('kecamatan') is-invalid @enderror" id="kecamatan"
                                            aria-describedby="kecamatan" placeholder="Kecamatan" name="kecamatan"
                                            value="{{ $data->kecamatan }}">
                                        @error('kecamatan')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="desa">Desa/Kelurahan</label>
                                        <input type="text" class="form-control @error('desa') is-invalid @enderror"
                                            id="desa" aria-describedby="desa" placeholder="Desa/Kelurahan"
                                            name="desa" value="{{ $data->desa }}">
                                        @error('desa')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('pageScript')
    <script>
        $(document).ready(function() {

            const API_URL = 'http://www.emsifa.com/api-wilayah-indonesia/api/';
            var s_provinces = $('#select_provinces');
            var s_regencies = $('#select_regencies');
            var s_districts = $('#select_districts');
            var s_villages = $('#select_villages');
            let province_id = '';
            let regency_id = '';
            let district_id = '';
            let village_id = '';

            function setProvince(value) {
                province_id = value;
            }

            function setRegency(value) {
                regency_id = value;
            }

            function setDistrict(value) {
                district_id = value;
            }

            function getProvinces() {
                $.get(`${API_URL}provinces.json`, function(res) {
                    s_provinces.html('');
                    s_provinces.append('<option disabled selected>-- Pilih Provinsi --</option>')
                    $.each(res, function(index, value) {
                        var selected_provinsi = "{{ $data->provinsi }}" === value.name ?
                            'selected' : ''
                        if ("{{ $data->provinsi }}" === value.name) {
                            setProvince(value.id)
                        }
                        s_provinces.append('<option data-id="' + value.id + '" value="' + value
                            .name +
                            '" ' + selected_provinsi + '>' + value.name +
                            '</option>');
                    });
                });
            }

            function getRegencies(id) {
                $.get(`${API_URL}regencies/${id}.json`, function(res) {
                    s_regencies.html('');
                    s_regencies.append('<option disabled selected>-- Pilih Kabupaten/Kota --</option>')
                    $.each(res, function(index, value) {
                        s_regencies.append('<option data-id="' + value.id + '" value="' + value
                            .name +
                            '">' + value.name + '</option>');
                    });
                });
            }

            function getDistricts(id) {
                $.get(`${API_URL}districts/${id}.json`, function(res) {
                    s_districts.html('');
                    s_districts.append('<option disabled selected>-- Pilih Kecamatan --</option>')
                    $.each(res, function(index, value) {
                        s_districts.append('<option data-id="' + value.id + '" value="' + value
                            .name +
                            '">' + value.name + '</option>');
                    });
                });
            }

            function getVillages(id) {
                $.get(`${API_URL}villages/${id}.json`, function(res) {
                    s_villages.html('');
                    s_villages.append('<option disabled selected>-- Pilih Desa/Kelurahan --</option>')
                    $.each(res, function(index, value) {
                        s_villages.append('<option data-id="' + value.id + '" value="' + value
                            .name +
                            '">' + value.name + '</option>');
                    });
                });
            }

            getProvinces();

            s_provinces.change(function() {
                getRegencies($(this).find(':selected').data("id"));
            });

            s_regencies.change(function() {
                getDistricts($(this).find(':selected').data("id"));
            });

            s_districts.change(function() {
                getVillages($(this).find(':selected').data("id"));
            });
        });
    </script>
@endsection
