@extends('template.app')

@section('title', 'Mata Kuliah')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Mata Kuliah</h1>
        </div>

        <div class="section-body">
            <div class="row">
                @foreach($mata_kuliah as $data)
                    @php
                        $arr = [];
                    @endphp
                    <div class="col-4">
                        <div class="card card-primary">
                            <div class="card-header flex-wrap">
                                <div class="badge badge-primary mr-2">{{ $data->kode }}</div>
                                <h4>{{ $data->mata_kuliah }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <h6 class="mb-0 text-muted">{{ ucfirst($data->hari) }}, {{ $data->waktu->format('H:i') }}</h6>
                                </div>
                                @foreach($data->krsDetail as $krs_detail)
                                    @php
                                        $arr[] = $krs_detail->krs->mahasiswa_nim;
                                    @endphp
                                @endforeach

                                @if(in_array(auth()->user()->mahasiswa->nim, $arr))
                                    <button type="button" data-kode="{{ $data->kode }}" class="btn btn-danger btn-block btn-batal-kontrak">Batalkan Kontrak Kuliah</button>
                                @else
                                    <button type="button" data-kode="{{ $data->kode }}" class="btn btn-primary btn-block btn-kontrak">Pilih Mata Kuliah</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12">
                    {{ $mata_kuliah->onEachSide(5)->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js-pages')
    <script>
        $(function() {
            // tekan tombol kontrak mata kuliah
            $('.btn-kontrak').on('click', function() {
                const kode = $(this).attr('data-kode');

                $.ajax({
                    url: "{{ url('/mata-kuliah/kontrak') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        kode
                    },
                    success: function() {
                        location.reload();
                    },
                    error: function() {
                        alert('Gagal simpan data');
                    }
                });
            });

            // tekan tombol batalkan kontrak mata kuliah
            $('.btn-batal-kontrak').on('click', function() {
                const kode = $(this).attr('data-kode');

                $.ajax({
                    url: "{{ url('/mata-kuliah/remove-kontrak') }}",
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        kode
                    },
                    success: function() {
                        location.reload();
                    },
                    error: function() {
                        alert('Gagal simpan data');
                    }
                });
            });
        });
    </script>
@endpush
