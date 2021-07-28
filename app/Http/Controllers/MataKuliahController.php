<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Krs;
use App\Models\Kelas;
use App\Models\KrsDetail;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MataKuliahController extends Controller {
    // bertujuan untuk menampung middleware (batas halaman antara admin dengan mahasiswa)
    public function __construct() {
        $this->middleware('role:admin,mahasiswa')->only('index');
        $this->middleware('role:mahasiswa')->only('kontrak', 'removeKontrak');
        $this->middleware('role:admin')->except('index', 'kontrak', 'removeKontrak');
    }

    // fungsi pada halaman mahasiswa
    // fungsi untuk kontrak mata kuliah
    public function kontrak(Request $request) {
        $kode_matkul = $request->kode;
        $kode_krs = 'KRS'.auth()->user()->mahasiswa->nim.time();
        $mahasiswa_nim = auth()->user()->mahasiswa->nim;
        $mahasiswa_kelas = auth()->user()->mahasiswa->kelas->kelas;

        // cek apakah krs sudah dimiliki di kelas ini
        $check = DB::table('krs')
                    ->where('mahasiswa_nim', '=', $mahasiswa_nim)
                    ->where('mahasiswa_kelas', '=', $mahasiswa_kelas);

        if($check->count() > 0) {
            $check = $check->get();
            $old_kode_krs = $check[0]->kode;

            KrsDetail::create([
                'krs_kode' => $old_kode_krs,
                'mata_kuliah_kode' => $kode_matkul
            ]);
        } else {
            DB::beginTransaction();
    
            try {
                Krs::create([
                    'kode' => $kode_krs,
                    'mahasiswa_nim' => $mahasiswa_nim,
                    'mahasiswa_kelas' => $mahasiswa_kelas
                ]);
    
                KrsDetail::create([
                    'krs_kode' => $kode_krs,
                    'mata_kuliah_kode' => $kode_matkul
                ]);
    
                DB::commit();
            } catch(\Exception $e) {
                abort(500);
    
                DB::rollback();
            }
        }
    }

    // fungsi untuk membatalkan kontrak mata kuliah
    public function removeKontrak(Request $request) {
        $kode_matkul = $request->kode;
        $mahasiswa_nim = auth()->user()->mahasiswa->nim;
        $mahasiswa_kelas = auth()->user()->mahasiswa->kelas->kelas;

        KrsDetail::where('mata_kuliah_kode', '=', $kode_matkul)
                    ->whereHas('krs', function($query) use($mahasiswa_nim, $mahasiswa_kelas) {
                        $query->where('mahasiswa_nim', '=', $mahasiswa_nim)
                                ->where('mahasiswa_kelas', '=', $mahasiswa_kelas);
                    })
                    ->delete();
    }
    
    // fungsi untuk menampilkan halaman index mata kuliah
    public function index() {
        if(auth()->user()->role == 'admin') {
            return view('mata_kuliah.index');
        }

        $mata_kuliah = MataKuliah::with(['krsDetail.krs' => function($q) {
            $q->select('kode', 'mahasiswa_nim');
        }])
                                    ->where('kelas_id', '=', auth()->user()->mahasiswa->kelas_id)
                                    ->orderByRaw("FIELD(hari , 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu') ASC")
                                    ->paginate(9);

        return view('mata_kuliah.index_mahasiswa', compact('mata_kuliah'));
    }

    public function json() {
        $data = MataKuliah::with('kelas');

        return DataTables::of($data)
            ->editColumn('hari', function($data) {
                return ucfirst($data->hari).', '.$data->waktu->format('H:i');
            })
            ->addColumn('aksi', function($data) {
                return '
                    <a href="'.route('mata-kuliah.show', $data->kode).'" class="btn btn-sm btn-info">Detail</a>
                    <a href="'.route('mata-kuliah.edit', $data->kode).'" class="btn btn-sm btn-warning">Edit</a>
                ';
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    // fungsi pada halaman admin
    // menampilkan halaman tambah mata kuliah dengan mengirimkan data kelas
    public function create() {
        $kelas = Kelas::latest()->get();

        return view('mata_kuliah.create', compact('kelas'));
    }

    // proses tambah mata kuliah dengan validasi
    public function store(Request $request) {

        // cari kelas yang sudah ada jawdal pada waktu ini
        $check = DB::table('mata_kuliah')
                    ->where('kelas_id', '=', $request->kelas_id)
                    ->where('waktu', '=', $request->waktu)
                    ->where('hari', '=', $request->hari)
                    ->count();

        if($check > 0) {
            return redirect()->back()->with('error', 'Kelas ini sudah ada mata kuliah pada '.$request->hari.', '.$request->waktu)->withInput($request->all());
        }

        $this->validate($request, [
            'kode' => 'unique:mata_kuliah,kode'
        ], [
            'kode.unique' => 'Kode sudah ada'
        ]);

        MataKuliah::create($request->except('_token'));

        return redirect()->route('mata-kuliah.index')->with('success', 'Data berhasil disimpan!');
    }

    // menampilkan halaman detail mata kuliah
    public function show($id) {
        $mata_kuliah = MataKuliah::with('kelas')->find($id);

        return view('mata_kuliah.show', compact('mata_kuliah'));
    }

    // menampilkan halaman edit mata kuliah
    public function edit($id) {
        $kelas = Kelas::latest()->get();
        $mata_kuliah = MataKuliah::find($id);

        return view('mata_kuliah.edit', compact('kelas', 'mata_kuliah'));
    }

    // proses update mata kuliah
    public function update(Request $request, $id) {
        // cari kelas yang sudah ada jawdal pada waktu ini
        $check = DB::table('mata_kuliah')
                    ->where('kelas_id', '=', $request->kelas_id)
                    ->where('waktu', '=', $request->waktu)
                    ->where('hari', '=', $request->hari)
                    ->where('kode', '!=', $id)
                    ->count();

        if($check > 0) {
            return redirect()->back()->with('error', 'Kelas ini sudah ada mata kuliah pada '.$request->hari.', '.$request->waktu)->withInput($request->all());
        }

        $mata_kuliah = MataKuliah::find($id);

        if($mata_kuliah->kode != $request->kode) {
            $this->validate($request, [
                'kode' => 'unique:mata_kuliah,kode'
            ], [
                'kode.unique' => 'Kode sudah ada'
            ]);
        }

        $mata_kuliah->update($request->except('_token', '_method'));

        return redirect()->route('mata-kuliah.index')->with('success', 'Data berhasil disimpan!');
    }

    // proses hapus mata kuliah
    public function destroy($id) {
        MataKuliah::find($id)->delete();

        return redirect()->route('mata-kuliah.index')->with('success', 'Data berhasil dihapus!');
    }
}
