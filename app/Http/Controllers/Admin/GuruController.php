<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuruRequest;
use App\Models\Guru;
use App\Models\MataPelajaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        $data = Guru::with(['jabatans', 'pengajars'])->get();
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
}
