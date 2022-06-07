<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JadwalRequest;
use App\Models\Days;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->tahun) {
            $tahun = TahunAkademik::find($request->tahun);
            $kelas = Kelas::with('jurusan')->get();
            return view('admin.jadwal.jadwal', compact('tahun', 'kelas'));
        } else {
            $tahun = TahunAkademik::get();
            return view('admin.jadwal.index', compact('tahun'));
        }
    }

    public function list(Request $request)
    {
        $tahun = TahunAkademik::find($request->tahun);
        $kelas = Kelas::with('jurusan')->find($request->kelas);
        $days = Days::get();
        $jadwal = Jadwal::with(['kelas.jurusan', 'mapel.pengajars'])->where('tahun_akademik_id', $tahun->id)->where('kelas_id', $kelas->id)->orderBy('urutan')->get();
        return view('admin.jadwal.list', compact('tahun', 'kelas', 'days', 'jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $tahun = TahunAkademik::find($request->tahun);
        $kelas = Kelas::with('jurusan')->find($request->kelas);
        $day = Days::find($request->day);
        $mapels = MataPelajaran::where('tahun_akademik_id', $tahun->id)->where('kelas_id', $kelas->id)->get();
        return view('admin.jadwal.create', compact('tahun', 'kelas', 'day', 'mapels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JadwalRequest $request)
    {
        $request->validated();
        Jadwal::create($request->all());
        return redirect()->route('jadwal.list', ['tahun' => $request->tahun_akademik_id, 'kelas' => $request->kelas_id])->with('success', 'Jadwal baru berhasil ditambahkan!');
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
        $data = Jadwal::findOrFail($id);
        try {
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data masih digunakan dalam data lain!');
        }
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
