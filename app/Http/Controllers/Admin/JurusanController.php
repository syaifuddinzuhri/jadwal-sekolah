<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JurusanRequest;
use App\Http\Requests\UpdateJurusanRequest;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Jurusan::get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="/jurusan/' . $data->id . '/edit" class="btn btn-sm btn-warning" >
                           <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                    $button .= '<a href="javascript:void(0)" data-id="' . $data->id . '" data-toggle="modal" data-target="#delete-jurusan-modal"class="btn btn-sm btn-danger delete-jurusan">
                           <i class="fa fa-trash" aria-hidden="true"></i></a>';
                    $button .= '</div>';
                    return $button;
                })
                ->make(true);
        }
        return view('admin.jurusan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JurusanRequest $request)
    {
        $request->validated();

        $exists = Jurusan::where('kode', $request->kode)->first();
        if ($exists) {
            return redirect()->back()->with('error', 'Kode jurusan sudah terdaftar!');
        }

        Jurusan::create($request->all());
        return redirect()->route('jurusan.index')->with('success', 'Jurusan baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Jurusan::find($id);
        if (!$data) {
            return redirect()->route('jurusan.index')->with('error', 'Jurusan tidak ditemukan!');
        }
        return view('admin.jurusan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJurusanRequest $request, $id)
    {
        $data = Jurusan::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Jurusan tidak ditemukan!');
        }
        $request->validate([
            'kode' => 'required|unique:jurusans,kode,' . $data->id,
        ], [
            'kode.unique' => 'Kode jurusan sudah terdaftar.',
        ]);
        $data->update($request->all());
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Jurusan::findOrFail($id);
        try {
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Jurusan ' . $data->nama . ' masih digunakan dalam data lain!');
        }
        return redirect()->back()->with('success', 'Jurusan berhasil dihapus.');
    }
}
