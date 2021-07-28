@extends('template.app')

@section('title', 'Kelas')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Kelas</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('kelas.index') }}">Kelas</a></div>
                <div class="breadcrumb-item">Detail Data</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Detail Data</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between flex-wrap">
                                    <strong>Kelas</strong>
                                    <span>{{ $kelas->kelas }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between flex-wrap">
                                    <strong>Fakultas</strong>
                                    <span>{{ $kelas->fakultas }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between flex-wrap">
                                    <strong>Jurusan</strong>
                                    <span>{{ $kelas->jurusan }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <form action="{{ route('kelas.destroy', $kelas->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">

                                <button type="submit" class="btn btn-danger mr-1">Hapus</button>
                                <a href="{{ route('kelas.index') }}" class="btn btn-outline-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
