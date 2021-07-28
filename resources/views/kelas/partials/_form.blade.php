<form action="{{ isset($kelas) ? route('kelas.update', $kelas->id) : route('kelas.store') }}" method="POST">
    @csrf
    @if(isset($kelas))
        <input type="hidden" name="_method" value="PUT">
    @endif
    <div class="form-group">
        <label for="kelas">Nama Kelas <span class="text-danger">*</span></label>
        <input type="text" id="kelas" class="form-control @error('kelas') is-invalid @enderror" name="kelas" placeholder="Nama Kelas" value="{{ isset($kelas) ? $kelas->kelas : old('kelas') }}" required>
        @error('kelas')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="fakultas">Fakultas <span class="text-danger">*</span></label>
        <input type="text" id="fakultas" class="form-control" name="fakultas" placeholder="Fakultas" value="{{ isset($kelas) ? $kelas->fakultas : old('fakultas') }}" required>
    </div>
    <div class="form-group">
        <label for="jurusan">Jurusan <span class="text-danger">*</span></label>
        <input type="text" id="jurusan" class="form-control" name="jurusan" placeholder="Jurusan" value="{{ isset($kelas) ? $kelas->jurusan : old('jurusan') }}" required>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary mr-1">Simpan</button>
        @if(isset($kelas))
            <a href="{{ route('kelas.index') }}" class="btn btn-outline-secondary">Kembali</a>
        @else
            <button type="reset" class="btn btn-outline-secondary">Reset</button>
        @endif
    </div>
</form>