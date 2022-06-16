<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Days;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        return view('guru.index');
    }

    public function jadwal(Request $request)
    {
        if ($request->tahun) {
            $tahun = TahunAkademik::find($request->tahun);
            $kelas = Kelas::with('jurusan')->get();
            return view('guru.jadwal-detail', compact('tahun', 'kelas'));
        } else {
            $tahun = TahunAkademik::get();
            return view('guru.jadwal', compact('tahun'));
        }
    }

    public function list(Request $request)
    {
        $tahun = TahunAkademik::find($request->tahun);
        $kelas = Kelas::with('jurusan')->find($request->kelas);
        $days = Days::get();
        $jadwal = Jadwal::with(['kelas.jurusan', 'mapel.pengajars'])->where('tahun_akademik_id', $tahun->id)->where('kelas_id', $kelas->id)->orderBy('urutan')->get();
        return view('guru.list', compact('tahun', 'kelas', 'days', 'jadwal'));
    }
}
