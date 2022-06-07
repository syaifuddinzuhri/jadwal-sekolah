<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TahunAkademikRequest;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TahunAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = TahunAkademik::get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('tahun', function ($data) {
                    return '<div>' . $data->tahun_1 . ' / ' . $data->tahun_2 . '</div>';
                })
                ->addColumn('smt', function ($data) {
                    return $data->semester == 1 ? 'Ganjil' : 'Genap';
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="/tahun-akademik/' . $data->id . '/edit" class="btn btn-sm btn-warning" >
                           <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                    $button .= '<a href="javascript:void(0)" data-id="' . $data->id . '" data-toggle="modal" data-target="#delete-tahun-akademik-modal"class="btn btn-sm btn-danger delete-tahun-akademik">
                           <i class="fa fa-trash" aria-hidden="true"></i></a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action', 'tahun', 'smt'])
                ->make(true);
        }
        return view('admin.tahun-akademik.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TahunAkademikRequest $request)
    {
        $request->validated();
        TahunAkademik::create($request->all());
        return redirect()->route('tahun-akademik.index')->with('success', 'Tahun akademik baru berhasil ditambahkan!');
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
        $data = TahunAkademik::find($id);
        if (!$data) {
            return redirect()->route('tahun-akademik.index')->with('error', 'Tahun akademik tidak ditemukan!');
        }
        return view('admin.tahun-akademik.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TahunAkademikRequest $request, $id)
    {
        $data = TahunAkademik::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Tahun akademik tidak ditemukan!');
        }
        $data->update($request->all());
        return redirect()->route('tahun-akademik.index')->with('success', 'Tahun akademik berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = TahunAkademik::findOrFail($id);
        try {
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Tahun akademik masih digunakan dalam data lain!');
        }
        return redirect()->back()->with('success', 'Tahun akademik berhasil dihapus.');
    }
}
