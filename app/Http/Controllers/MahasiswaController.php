<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MahasiswaRequest;

class MahasiswaController extends Controller {

    // menampilkan halaman index mahasiswa
    public function index() {
        return view('mahasiswa.index');
    }

    // berisi data mahasiswa dengan format json untuk dikirim ke tabel pada halaman index mahasiswa
    public function json() {
        $data = Mahasiswa::with('kelas');

        return DataTables::of($data)
            ->addColumn('aksi', function($data) {
                return '
                    <a href="'.route('mahasiswa.show', $data->nim).'" class="btn btn-sm btn-info">Detail</a>
                    <a href="'.route('mahasiswa.edit', $data->nim).'" class="btn btn-sm btn-warning">Edit</a>
                ';
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    // menampilkan halaman tambah mahasiswa
    public function create() {
        $kelas = Kelas::latest()->get();

        return view('mahasiswa.create', compact('kelas'));
    }

    // proses tambah mahasiswa dengan menggunakan transactional db berfungsi agar semua data terkirim ke database dengan sempurna
    public function store(MahasiswaRequest $request) {
        DB::beginTransaction();

        try {
            $user = User::create([
                'username' => $request->nim,
                'password' => bcrypt($request->nim),
                'role' => 'mahasiswa'
            ]);

            Mahasiswa::create([
                'nim' => $request->nim,
                'user_id' => $user->id,
                'kelas_id' => $request->kelas_id,
                'nama' => $request->nama,
                'jk' => $request->jk
            ]);

            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();

            abort(500);
        }

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil disimpan!');
    }

    // menampilkan halaman detail mahasiswa
    public function show($id) {
        $mahasiswa = Mahasiswa::with('kelas')->find($id);

        return view('mahasiswa.show', compact('mahasiswa'));
    }

    // menampilkan halaman edit mahasiswa
    public function edit($id) {
        $mahasiswa = Mahasiswa::find($id);
        $kelas = Kelas::latest()->get();

        return view('mahasiswa.edit', compact('mahasiswa', 'kelas'));
    }

    // proses update mahasiswa dengan menggunakan transactional db
    public function update(Request $request, $id) {
        $mahasiswa = Mahasiswa::find($id);

        if($request->nim != $mahasiswa->nim) {
            $this->validate($request, [
                'nim' => 'unique:mahasiswa,nim'
            ], [
                'nim.unique' => 'NIM sudah ada'
            ]);
        }

        DB::beginTransaction();

        try {
            $mahasiswa->user->update([
                'username' => $request->nim,
                'password' => bcrypt($request->nim)
            ]);

            $mahasiswa->update([
                'nim' => $request->nim,
                'kelas_id' => $request->kelas_id,
                'nama' => $request->nama,
                'jk' => $request->jk
            ]);

            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();

            abort(500);
        }

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil disimpan!'); 
    }

    // proses hapus mahasiswa
    public function destroy($id) {
        Mahasiswa::find($id)->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil dihapus!');        
    }
}
