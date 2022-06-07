<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiswaRequest;
use App\Models\Kelas;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Siswa::with(['kelas.jurusan'])->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('ttl', function ($data) {
                    return $data->tempat_lahir . ', ' . Carbon::parse($data->tgl_lahir)->isoFormat('D MMMM Y');
                })
                ->addColumn('kelas', function ($data) {
                    return '<div>' . $data->kelas->tingkat . ' ' . $data->kelas->nama . ' / ' . $data->kelas->jurusan->nama . '</div>';
                })
                ->addColumn('jk', function ($data) {
                    return $data->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan';
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="/siswa/' . $data->id . '/edit" class="btn btn-sm btn-warning" >
                           <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                    $button .= '<a href="javascript:void(0)" data-id="' . $data->id . '" data-toggle="modal" data-target="#delete-siswa-modal"class="btn btn-sm btn-danger delete-siswa">
                           <i class="fa fa-trash" aria-hidden="true"></i></a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action', 'ttl', 'jk', 'kelas'])
                ->make(true);
        }
        return view('admin.siswa.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::with('jurusan')->get();
        return view('admin.siswa.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SiswaRequest $request)
    {
        $request->validated();
        $payload = $request->all();
        Siswa::create($payload);
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
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
        $kelas = Kelas::with('jurusan')->get();
        $data = Siswa::find($id);
        if (!$data) {
            return redirect()->route('siswa.index')->with('error', 'Siswa tidak ditemukan!');
        }
        return view('admin.siswa.edit', compact('kelas', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SiswaRequest $request, $id)
    {
        $request->validated();
        $data = Siswa::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Siswa tidak ditemukan!');
        }
        $payload = $request->all();
        $data->update($payload);
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Siswa::findOrFail($id);
        try {
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Siswa masih digunakan dalam data lain!');
        }
        return redirect()->back()->with('success', 'Siswa berhasil dihapus.');
    }
}
