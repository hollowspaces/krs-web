<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Http\Requests\KelasRequest;

class KelasController extends Controller {
    
    // menampilkan halaman kelas (index)
    public function index() {
        return view('kelas.index');
    }

    // proses kirim data dari tabel kelas di convert ke dalam bentuk json untuk dikonsumsi oleh datatabel
    public function json() {
        $data = Kelas::query();

        return DataTables::of($data)
            ->addColumn('aksi', function($data) {
                return '
                    <a href="'.route('kelas.show', $data->id).'" class="btn btn-sm btn-info">Detail</a>
                    <a href="'.route('kelas.edit', $data->id).'" class="btn btn-sm btn-warning">Edit</a>
                ';
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    // menampilkan halaman tambah kelas
    public function create() {
        return view('kelas.create');
    }

    // proses tambah kelas
    public function store(KelasRequest $request) {
        Kelas::create($request->except('_token'));

        return redirect()->route('kelas.index')->with('success', 'Data berhasil disimpan!');
    }

    // menampilkan halaman detail kelas
    public function show($id) {
        $kelas = Kelas::find($id);

        return view('kelas.show', compact('kelas'));
    }

    // menampilkan halaman edit kelas
    public function edit($id) {
        $kelas = Kelas::find($id);

        return view('kelas.edit', compact('kelas'));
    }

    // proses update kelas
    public function update(KelasRequest $request, $id) {
        Kelas::find($id)->update($request->except('_token', '_method'));

        return redirect()->route('kelas.index')->with('success', 'Data berhasil disimpan!');
    }

    // proses hapus kelas
    public function destroy($id) {
        Kelas::find($id)->delete();

        return redirect()->route('kelas.index')->with('success', 'Data berhasil dihapus!');
    }
}
