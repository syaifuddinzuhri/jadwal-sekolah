<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMapelRequest;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\TahunAkademik;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = MataPelajaran::with(['kelas.jurusan', 'tahun_akademik'])->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('tahun', function ($data) {
                    return '<div>' . $data->tahun_akademik->tahun_1 . ' / ' . $data->tahun_akademik->tahun_2 . '</div>';
                })
                ->addColumn('waktu', function ($data) {
                    return '<div>' . $data->start . ' - ' . $data->end . '</div>';
                })
                ->addColumn('kelas', function ($data) {
                    return '<div>' . $data->kelas->tingkat . ' ' . $data->kelas->nama . ' / ' . $data->kelas->jurusan->nama . '</div>';
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="/mapel/' . $data->id . '/edit" class="btn btn-sm btn-warning" >
                           <i class="fa fa-edit" aria-hidden="true"></i> </a>';
                    $button .= '<a href="javascript:void(0)" data-id="' . $data->id . '" data-toggle="modal" data-target="#delete-mapel-modal"class="btn btn-sm btn-danger delete-mapel">
                           <i class="fa fa-trash" aria-hidden="true"></i></a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action', 'tahun', 'kelas', 'waktu'])
                ->make(true);
        }
        return view('admin.mapel.index', compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::with('jurusan')->get();
        $tahun = TahunAkademik::get();
        return view('admin.mapel.create', compact('kelas', 'tahun'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMapelRequest $request)
    {
        $request->validated();
        $payload = $request->all();
        $payload['start'] = Carbon::parse($request->start)->format('h:i');
        $payload['end'] = Carbon::parse($request->end)->format('h:i');
        MataPelajaran::create($payload);
        return redirect()->route('mapel.index')->with('success', 'Mata pelajaran baru berhasil ditambahkan!');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
