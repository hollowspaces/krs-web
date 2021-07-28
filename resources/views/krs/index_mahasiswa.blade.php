@extends('template.app')

@section('title', 'KRS')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>KRS</h1>
        </div>

        <div class="section-body">
            <div class="row">
                @foreach($krs as $data)
                    <div class="col-4">
                        <div class="card card-app-design">
                            <div class="card-body">
                                <div class="badge badge-primary">{{ $data->mahasiswa_kelas }}</div>

                                <div class="my-3">
                                    {!! QrCode::size(250)->generate(route('krs.show', $data->kode)); !!}
                                </div>

                                <h6 class="text-muted">Mata Kuliah : {{ $data->krs_detail_count }}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12">
                    {{ $krs->onEachSide(5)->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
