<form method="POST" action="{{ route('kriteria.update', $data->id_kriteria) }}">
    @csrf
    @method('PUT')

    <div class="form-group mb-3">
        <label class="form-label">Kode Kriteria</label>
        <input type="text" class="form-control" placeholder="Kode Kriteria" name="kode_kriteria"
            value="{{ $data->kode_kriteria }}" required>
    </div>

    <div class="form-group mb-3">
        <label class="form-label">Nama Kriteria</label>
        <input type="text" class="form-control" placeholder="Nama Kriteria" name="nama_kriteria"
            value="{{ $data->nama_kriteria }}" required>
    </div>

    {{-- ERROR MESSAGE --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="d-flex justify-content-end gap-2 mt-4">

        <a href="{{ route('kriteria.index') }}" class="btn btn-danger">
            Batal
        </a>

        <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
            <i class="ti ti-device-floppy"></i>
            Simpan
        </button>

    </div>
</form>
