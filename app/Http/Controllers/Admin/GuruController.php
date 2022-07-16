<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuruRequest;
use App\Models\Guru;
use App\Models\GuruPengajar;
use App\Models\MataPelajaran;
use App\Models\TahunAkademik;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Guru::with(['pengajars'])->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('nama_lengkap', function ($data) {
                    return $data->nama . ',' . $data->gelar;
                })
                ->addColumn('alamat_lengkap', function ($data) {
                    return $data->alamat . ', ' . $data->desa . ', Kec. ' . $data->kecamatan . ', ' . $data->kab_kota . ', Prov. ' . $data->provinsi;
                })
                ->addColumn('ttl', function ($data) {
                    return $data->tempat_lahir . ', ' . Carbon::parse($data->tgl_lahir)->isoFormat('D MMMM Y');
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="/guru/' . $data->id . '/edit" class="btn btn-sm btn-warning" >
                           <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                    $button .= '<a href="/guru/pengajar/' . $data->id . '" class="btn btn-sm btn-success" >
                           <i class="fa fa-book" aria-hidden="true"></i> </a>';
                    $button .= '<a href="javascript:void(0)" data-id="' . $data->id . '" data-toggle="modal" data-target="#delete-guru-modal"class="btn btn-sm btn-danger delete-guru">
                           <i class="fa fa-trash" aria-hidden="true"></i></a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action', 'nama_lengkap', 'alamat_lengkap', 'ttl'])
                ->make(true);
        }
        return view('admin.guru.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.guru.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGuruRequest $request)
    {
        $request->validated();
        $payload = $request->all();
        Guru::create($payload);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Guru::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan');
        }
        return view('admin.guru.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGuruRequest $request, $id)
    {
        $request->validated();
        $data = Guru::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan');
        }
        $data->update($request->all());

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Guru::findOrFail($id);
        try {
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data guru masih digunakan dalam data lain!');
        }
        return redirect()->back()->with('success', 'Data guru berhasil dihapus.');
    }

    public function pengajar($id, Request $request)
    {
        $tahun = $request->tahun ?? null;
        $query_tahun = TahunAkademik::query();
        if ($tahun == null) {
            $query_tahun->latest();
        } else {
            $query_tahun->where('id', $tahun);
        }
        $tahun = $query_tahun->first();
        $all_tahun = TahunAkademik::get();
        $query_mapel = MataPelajaran::with('kelas.jurusan');
        if ($tahun) {
            $query_mapel->where('tahun_akademik_id', $tahun->id);
        }
        $mapel = $query_mapel->doesntHave('pengajars')->get();
        $guru = Guru::with(['pengajars'])->find($id);
        $data_guru = Guru::find($id);
        $query = GuruPengajar::with('mapel.kelas.jurusan');
        if ($tahun) {
            $query->whereHas('mapel', function ($q) use ($tahun) {
                $q->where('tahun_akademik_id', $tahun->id);
            });
        }
        $mapels = $query->where('guru_id', $id)->get();
        return view('admin.guru.pengajar', compact('data_guru', 'guru', 'tahun', 'mapel', 'all_tahun', 'mapels'));
    }

    public function simpanmapel(Request $request)
    {
        $guru = Guru::find($request->id);
        // if ($request->isMethod('post')) {
        $guru->mapels()->attach($request->mapels);
        // }
        // if ($request->isMethod('put')){
        // $guru->mapels()->sync($request->mapels);
        // }
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil di update');
    }

    public function hapusmapel($id)
    {
        $data = GuruPengajar::findOrFail($id);
        try {
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data masih digunakan dalam data lain!');
        }
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
