@extends('template.app')

@section('title', 'Mata Kuliah')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Mata Kuliah</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('mata-kuliah.index') }}">Mata Kuliah</a></div>
                <div class="breadcrumb-item">Tambah Data</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            <div class="alert-body">
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Data</h4>
                        </div>
                        <div class="card-body">
                            @include('mata_kuliah.partials._form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
