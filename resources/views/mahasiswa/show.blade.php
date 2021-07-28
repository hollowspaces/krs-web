@extends('template.app')

@section('title', 'Mahasiswa')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Mahasiswa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('mahasiswa.index') }}">Mahasiswa</a></div>
                <div class="breadcrumb-item">Detail Data</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="alert alert-primary">
                        <strong>Informasi Akun</strong>
                        <p class="mt-1">Default username & password diisi oleh NIM</p>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Detail Data</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between flex-wrap">
                                    <strong>NIM</strong>
                                    <span>{{ $mahasiswa->nim }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between flex-wrap">
                                    <strong>Nama</strong>
                                    <span>{{ $mahasiswa->nama }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between flex-wrap">
                                    <strong>Jenis Kelamin</strong>
                                    <span>{{ $mahasiswa->jk == 'l' ? 'Laki-laki' : 'Perempuan' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between flex-wrap">
                                    <strong>Kelas</strong>
                                    <span>{{ $mahasiswa->kelas->kelas }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <form action="{{ route('mahasiswa.destroy', $mahasiswa->nim) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">

                                <button type="submit" class="btn btn-danger mr-1">Hapus</button>
                                <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
