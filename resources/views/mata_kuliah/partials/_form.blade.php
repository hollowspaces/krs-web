<form method="POST" action="{{ isset($mata_kuliah) ? route('mata-kuliah.update', $mata_kuliah->kode) : route('mata-kuliah.store') }}">
    @csrf
    @if(isset($mata_kuliah))
        <input type="hidden" name="_method" value="PUT">
    @endif
    <div class="form-group">
        <label for="kode">Kode <span class="text-danger">*</span></label>
        <input type="text" id="kode" class="form-control @error('kode') is-invalid @enderror" name="kode" placeholder="Kode" value="{{ isset($mata_kuliah) ? $mata_kuliah->kode : old('kode') }}" required>
        @error('kode')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="mata_kuliah">Mata Kuliah <span class="text-danger">*</span></label>
        <input type="text" id="mata_kuliah" class="form-control" name="mata_kuliah" placeholder="Mata Kuliah" value="{{ isset($mata_kuliah) ? $mata_kuliah->mata_kuliah : old('mata_kuliah') }}" required>
    </div>
    <div class="form-group">
        <label for="waktu">Waktu <span class="text-danger">*</span></label>
        <input type="time" id="waktu" class="form-control" name="waktu" placeholder="Waktu" value="{{ isset($mata_kuliah) ? $mata_kuliah->waktu->format('H:i') : old('waktu') }}" required>
    </div>
    <div class="form-group">
        <label for="hari">Hari <span class="text-danger">*</span></label>
        <select id="hari" class="form-control" name="hari" required>
            <option value="" selected>Pilih Hari</option>
            <option {{ old('hari') == 'senin' || (isset($mata_kuliah) && $mata_kuliah->hari == 'senin') ? 'selected' : '' }} value="senin">Senin</option>
            <option {{ old('hari') == 'selasa' || (isset($mata_kuliah) && $mata_kuliah->hari == 'selasa') ? 'selected' : '' }} value="selasa">Selasa</option>
            <option {{ old('hari') == 'rabu' || (isset($mata_kuliah) && $mata_kuliah->hari == 'rabu') ? 'selected' : '' }} value="rabu">Rabu</option>
            <option {{ old('hari') == 'kamis' || (isset($mata_kuliah) && $mata_kuliah->hari == 'kamis') ? 'selected' : '' }} value="kamis">Kamis</option>
            <option {{ old('hari') == 'jumat' || (isset($mata_kuliah) && $mata_kuliah->hari == 'jumat') ? 'selected' : '' }} value="jumat">Jumat</option>
            <option {{ old('hari') == 'sabtu' || (isset($mata_kuliah) && $mata_kuliah->hari == 'sabtu') ? 'selected' : '' }} value="sabtu">Sabtu</option>
        </select>
    </div>
    <div class="form-group">
        <label for="kelas_id">Kelas <span class="text-danger">*</span></label>
        <select id="kelas_id" class="form-control" name="kelas_id" required>
            <option value="" selected>Pilih Kelas</option>
            @foreach($kelas as $k)
                <option {{ old('kelas_id') == $k->id || (isset($mata_kuliah) && $mata_kuliah->kelas_id == $k->id) ? 'selected' : '' }} value="{{ $k->id }}">{{ $k->kelas }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary mr-1">Simpan</button>
        @if(isset($mata_kuliah))
            <a href="{{ route('mata-kuliah.index') }}" class="btn btn-outline-secondary">Kembali</a>
        @else
            <button type="reset" class="btn btn-outline-secondary">Reset</button>
        @endif
    </div>
</form>