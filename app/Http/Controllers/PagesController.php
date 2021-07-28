<?php

namespace App\Http\Controllers;

use App\Models\KrsDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller {

    // menampilkan halaman utama (dashboard) dengan mengirimkan data jumlah pada setiap tabel
    public function getIndex() {
        $mahasiswa = DB::table('mahasiswa')->count();
        $kelas = DB::table('kelas')->count();
        $mata_kuliah = DB::table('mata_kuliah')->count();
        $krs = DB::table('krs')->count();

        if(auth()->user()->role == 'mahasiswa') {
            $mata_kuliah = KrsDetail::whereHas('krs', function($query) {
                $query->where('mahasiswa_nim', '=', auth()->user()->mahasiswa->nim)
                        ->where('mahasiswa_kelas', '=', auth()->user()->mahasiswa->kelas->kelas);
            })
            ->count();

            $krs = DB::table('krs')->where('mahasiswa_nim', '=', auth()->user()->mahasiswa->nim)->count();
        }

        return view('pages.index', compact('mahasiswa', 'kelas', 'mata_kuliah', 'krs'));
    }
}
