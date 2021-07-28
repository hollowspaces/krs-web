@extends('template.app')

@section('title', 'KRS')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail KRS</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('krs.index') }}">KRS</a></div>
                <div class="breadcrumb-item">Detail Data</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Detail Data</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @if(auth()->user()->role == 'admin')
                                    <li class="list-group-item d-flex justify-content-between flex-wrap">
                                        <strong>Mahasiswa</strong>
                                        <span>{{ $krs->mahasiswa->nama }}</span>
                                    </li>
                                @endif
                                <li class="list-group-item d-flex justify-content-between flex-wrap">
                                    <strong>Nama</strong>
                                    <span>{{ $krs->mahasiswa->nama }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between flex-wrap">
                                    <strong>NIM</strong>
                                    <span>{{ $krs->mahasiswa->nim }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between flex-wrap">
                                    <strong>Kode KRS</strong>
                                    <span>{{ $krs->kode }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <form action="{{ route('krs.destroy', $krs->kode) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                @if(auth()->user()->role == 'admin')
                                    <button type="submit" class="btn btn-danger mr-1">Hapus</button>
                                @endif
                                <a href="{{ route('krs.index') }}" class="btn btn-outline-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Detail Mata Kuliah</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mata Kuliah</th>
                                        <th>Kode</th>
                                        <th>Hari</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($krs_detail as $key => $d)
                                        <tr>
                                            <td>{{ $krs_detail->firstItem() + $key }}</td>
                                            <td>{{ $d->mataKuliah->mata_kuliah }}</td>
                                            <td>{{ $d->mataKuliah->kode }}</td>
                                            <td>{{ $d->mataKuliah->hari }}</td>
                                            <td>{{ $d->mataKuliah->waktu }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $krs_detail->onEachSide(5)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
