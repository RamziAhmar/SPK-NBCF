<form method="POST" action="{{ route('sub_kriteria.update', $data->id_sub_kriteria) }}">
    @csrf
    @method('PUT')
    <div class="form-group mb-3">
        <label class="form-label">Kriteria</label>
        <select class="form-control" name="id_kriteria" required>
            <option value="">Pilih Kriteria</option>
            @foreach ($kriteria as $item)
                <option value="{{ $item->id_kriteria }}" {{ $data->id_kriteria == $item->id_kriteria ? 'selected' : '' }}>
                    {{ $item->nama_kriteria }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group mb-3">
        <label class="form-label">Nama Sub Kriteria</label>
        <input type="text" class="form-control" placeholder="Nama Sub Kriteria" name="nama_sub"
            value="{{ $data->nama_sub }}" required>
    </div>
    
    <div class="form-group mb-3">
        <label class="form-label">Keterangan</label>
        <textarea class="form-control" placeholder="Keterangan" name="keterangan" required>{{ $data->keterangan }}</textarea>
    </div>
    
    <div class="form-group mb-3">
        <label class="form-label">Nilai</label>
        <input type="number" class="form-control" placeholder="Nilai" name="nilai" step="0.1" min="0" max="1" value="{{ $data->nilai }}" required>
    </div>

    {{-- ERROR MESSAGE --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="d-flex justify-content-end gap-2 mt-4">

        <a href="{{ route('sub_kriteria.index') }}" class="btn btn-danger">
            Batal
        </a>

        <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
            <i class="ti ti-device-floppy"></i>
            Simpan
        </button>

    </div>
</form>
