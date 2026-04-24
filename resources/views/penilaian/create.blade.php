<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('penilaian.store') }}">
                @csrf

                <div class="form-group mb-3">
                    <label class="form-label">Nama Alternatif</label>
                    <input type="text" class="form-control" placeholder="Nama Alternatif" name="nama_alternatif"
                        value="{{ old('nama_alternatif') }}" required>
                </div>

                @foreach ($kriteria as $k)
                    <div class="form-group mb-3">
                        <label class="form-label">{{ $k->nama_kriteria }}</label>
                        <select name="kriteria[{{ $k->id_kriteria }}]" class="form-control" required>
                            <option value="">Pilih {{ $k->nama_kriteria }}</option>
                            @foreach ($k->subKriteria as $sub)
                                <option value="{{ $sub->id_sub_kriteria }}">
                                    {{ $sub->nama_sub }} ({{ $sub->nilai }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endforeach

                {{-- ERROR MESSAGE --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="d-flex justify-content-end gap-2 mt-4">

                    <a href="{{ route('penilaian.index') }}" class="btn btn-danger">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                        <i class="ti ti-device-floppy"></i>
                        Simpan
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>
