<form method="POST" action="{{ isset($mahasiswa) ? route('mahasiswa.update', $mahasiswa->nim) : route('mahasiswa.store') }}">
    @csrf
    @if(isset($mahasiswa))
        <input type="hidden" name="_method" value="PUT">
    @endif
    <div class="form-group">
        <label for="nim">NIM <span class="text-danger">*</span></label>
        <input type="number" min="1" id="nim" class="form-control @error('nim') is-invalid @enderror" name="nim" placeholder="NIM" value="{{ isset($mahasiswa) ? $mahasiswa->nim : old('nim') }}" required>
        @error('nim')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
        <input type="text" id="nama" class="form-control" name="nama" placeholder="Nama Lengkap" value="{{ isset($mahasiswa) ? $mahasiswa->nama : old('nama') }}" required>
    </div>
    <div class="form-group">
        <label for="jk">Jenis Kelamin <span class="text-danger"></span></label>
        <div class="d-flex align-items-center">
            <div class="custom-control custom-radio mr-2">
                <input type="radio" id="l" name="jk" class="custom-control-input" value="l" {{ (!isset($mahasiswa) && old('jk') != 'p') || (isset($mahasiswa) && $mahasiswa->jk == 'l') ? 'checked' : '' }}>
                <label class="custom-control-label" for="l">Laki-laki</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" id="p" name="jk" class="custom-control-input" value="p" {{ old('jk') == 'p' || (isset($mahasiswa) && $mahasiswa->jk == 'p') ? 'checked' : '' }}>
                <label class="custom-control-label" for="p">Perempuan</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="kelas_id">Kelas <span class="text-danger">*</span></label>
        <select id="kelas_id" class="form-control" name="kelas_id" required>
            <option value="" selected>Pilih Kelas</option>
            @foreach($kelas as $k)
                <option {{ old('kelas_id') == $k->id || (isset($mahasiswa) && $mahasiswa->kelas_id == $k->id) ? 'selected' : '' }} value="{{ $k->id }}">{{ $k->kelas }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary mr-1">Simpan</button>
        @if(isset($mahasiswa))
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">Kembali</a>
        @else
            <button type="reset" class="btn btn-outline-secondary">Reset</button>
        @endif
    </div>
</form>