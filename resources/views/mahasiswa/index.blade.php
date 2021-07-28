@extends('template.app')

@section('title', 'Mahasiswa')

@push('css-libraries')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/DataTables/DataTables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/DataTables/Responsive/css/responsive.bootstrap4.min.css') }}">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Mahasiswa</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header justify-content-between align-items-center">
                            <h4>Data Mahasiswa</h4>
                            <a href="{{ route('mahasiswa.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Fakultas</th>
                                            <th>Created At</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js-libraries')
    <script src="{{ asset('vendors/DataTables/DataTables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/DataTables/DataTables/js/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/DataTables/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendors/DataTables/Responsive/js/responsive.bootstrap4.js') }}"></script>
@endpush

@push('js-pages')
    <script>
        $(function() {
            // datatable
            $('table').dataTable({
                serverSide: true,
                processing: true,
                responsive: true,
                ajax: {
                    url: "{{ route('mahasiswa.json') }}",
                    headers: {
                        'X-CSRF-TOKEN' : "{{ csrf_token() }}"
                    },
                    method: 'POST'
                },
                columns: [
                    { data: 'nim', name: 'nim' },
                    { data: 'nama', name: 'nama' },
                    { data: 'kelas.kelas', name: 'kelas.kelas' },
                    { data: 'kelas.fakultas', name: 'kelas.fakultas' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'aksi', name: 'aksi' }
                ],
                columnDefs: [
                    {
                        targets: 5,
                        orderable: false
                    },
                    {
                        targets: 4,
                        visible: false
                    }
                ],
                order: [[4, 'desc']]
            });
        });
    </script>
@endpush
