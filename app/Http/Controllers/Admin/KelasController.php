<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKelasRequest;
use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Kelas::with('jurusan')->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="/kelas/' . $data->id . '/edit" class="btn btn-sm btn-warning" >
                           <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                    $button .= '<a href="javascript:void(0)" data-id="' . $data->id . '" data-toggle="modal" data-target="#delete-kelas-modal"class="btn btn-sm btn-danger delete-kelas">
                           <i class="fa fa-trash" aria-hidden="true"></i></a>';
                    $button .= '</div>';
                    return $button;
                })
                ->make(true);
        }
        return view('admin.kelas.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jurusan = Jurusan::get();
        return view('admin.kelas.create', compact('jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKelasRequest $request)
    {
        $request->validated();
        Kelas::create($request->all());
        return redirect()->route('kelas.index')->with('success', 'Kelas baru berhasil ditambahkan!');
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
        $data = Kelas::with('jurusan')->find($id);
        $jurusan = Jurusan::get();

        if (!$data) {
            return redirect()->route('jurusan.index')->with('error', 'Jurusan tidak ditemukan!');
        }
        return view('admin.kelas.edit', compact('data', 'jurusan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Kelas::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Kelas tidak ditemukan!');
        }
        $data->update($request->all());
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Kelas::findOrFail($id);
        try {
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Kelas masih digunakan dalam data lain!');
        }
        return redirect()->back()->with('success', 'Kelas berhasil dihapus.');
    }
}
