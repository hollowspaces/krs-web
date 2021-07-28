@extends('template.app')

@section('title', 'Mahasiswa')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Mahasiswa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('mahasiswa.index') }}">Mahasiswa</a></div>
                <div class="breadcrumb-item">Tambah Data</div>
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
                            <h4 class="card-title">Tambah Data</h4>
                        </div>
                        <div class="card-body">
                            @include('mahasiswa.partials._form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
