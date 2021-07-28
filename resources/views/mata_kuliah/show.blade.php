@extends('template.app')

@section('title', 'Mata Kuliah')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Mata Kuliah</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('mata-kuliah.index') }}">Mata Kuliah</a></div>
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
                                    <strong>Kode</strong>
                                    <span>{{ $mata_kuliah->kode }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between flex-wrap">
                                    <strong>Mata Kuliah</strong>
                                    <span>{{ $mata_kuliah->mata_kuliah }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between flex-wrap">
                                    <strong>Waktu</strong>
                                    <span>{{ $mata_kuliah->waktu->format('H:i') }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between flex-wrap">
                                    <strong>Kelas</strong>
                                    <span>{{ $mata_kuliah->kelas->kelas }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <form action="{{ route('mata-kuliah.destroy', $mata_kuliah->kode) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">

                                <button type="submit" class="btn btn-danger mr-1">Hapus</button>
                                <a href="{{ route('mata-kuliah.index') }}" class="btn btn-outline-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
