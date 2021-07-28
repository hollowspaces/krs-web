<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Krs;
use App\Models\KrsDetail;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class KrsController extends Controller {
    // bertujuan untuk menampung middleware (batas halaman antara admin dengan mahasiswa)
    public function __construct() {
        $this->middleware('role:admin,mahasiswa')->only('index', 'show');
        $this->middleware('role:admin')->except('index', 'show');
    }

    // menampilkan halaman index krs, terdapat 2 index (untuk admin dan mahasiswa)
    public function index() {
        if(auth()->user()->role == 'admin') {
            return view('krs.index');
        }

        $krs = Krs::withCount('krsDetail')->where('mahasiswa_nim', '=', auth()->user()->mahasiswa->nim)->latest()->paginate(9);

        return view('krs.index_mahasiswa', compact('krs'));
    }

    // kirim data krs ke tabel pada halaman index admin
    public function json() {
        $data = Krs::with(['mahasiswa', 'mahasiswa.kelas'])->withCount('krsDetail');

        return DataTables::of($data)
                            ->addColumn('nama_mahasiswa', function($data) {
                                return '<a href="'.route('mahasiswa.show', $data->mahasiswa->nim).'" target="_blank">'.$data->mahasiswa->nama.'</a>';
                            })
                            ->addColumn('aksi', function($data) {
                                return '
                                    <a href="'.route('krs.show', $data->kode).'" class="btn btn-sm btn-info">Detail</a>
                                ';
                            })
                            ->rawColumns(['aksi', 'nama_mahasiswa'])
                            ->toJson();
    }

    // menampilkan halaman detail krs (bisa di scan dari qr code)
    public function show($id) {

        // cek apakah yang akses url ini adalah mahasiswa dengan nim yang bersangkutan atau admin
        $krs = Krs::with('mahasiswa')->find($id);
        
        if((auth()->user()->role == 'mahasiswa' && $krs->mahasiswa_nim == auth()->user()->mahasiswa->nim) || auth()->user()->role == 'admin') {
            $krs_detail = KrsDetail::with('mataKuliah')->where('krs_kode', '=', $id)->paginate(10);
    
            return view('krs.show', compact('krs', 'krs_detail'));
        }

        abort(404);
    }

    // fungsi hapus krs
    public function destroy($id) {
        Krs::find($id)->delete();

        return redirect()->route('krs.index')->with('success', 'Data berhasil dihapus!'); 
    }
}
