@extends('template.app')

@section('title', 'Kelas')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Kelas</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('kelas.index') }}">Kelas</a></div>
                <div class="breadcrumb-item">Tambah Data</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Data</h4>
                        </div>
                        <div class="card-body">
                            @include('kelas.partials._form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
