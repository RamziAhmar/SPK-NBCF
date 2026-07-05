<div class="col-sm-12">
    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ route('sub_kriteria.store') }}">
                @csrf

                <div class="form-group mb-3">
                    <label class="form-label">Kriteria</label>

                    <select class="form-control" name="id_kriteria" required>
                        <option value="">Pilih Kriteria</option>

                        @foreach ($kriteria as $item)
                            <option value="{{ $item->id_kriteria }}"
                                {{ old('id_kriteria') == $item->id_kriteria ? 'selected' : '' }}>
                                {{ $item->nama_kriteria }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Nama Sub Kriteria</label>

                    <input type="text"
                        class="form-control"
                        placeholder="Nama Sub Kriteria"
                        name="nama_sub"
                        value="{{ old('nama_sub') }}"
                        required>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Keterangan</label>

                    <textarea class="form-control"
                        placeholder="Keterangan"
                        name="keterangan"
                        required>{{ old('keterangan') }}</textarea>
                </div>

                <div class="row">

                    {{-- MB --}}
                    <div class="col-md-4">
                        <div class="form-group mb-3">

                            <label class="form-label">
                                Measure of Belief (MB)
                            </label>

                            <input type="number"
                                class="form-control"
                                id="mb"
                                name="mb"
                                placeholder="0.00"
                                min="0"
                                max="1"
                                step="0.1"
                                value="{{ old('mb') }}"
                                required>

                        </div>
                    </div>

                    {{-- MD --}}
                    <div class="col-md-4">
                        <div class="form-group mb-3">

                            <label class="form-label">
                                Measure of Disbelief (MD)
                            </label>

                            <input type="number"
                                class="form-control"
                                id="md"
                                name="md"
                                placeholder="0.00"
                                min="0"
                                max="1"
                                step="0.1"
                                value="{{ old('md') }}"
                                required>

                        </div>
                    </div>

                    {{-- CF PAKAR --}}
                    <div class="col-md-4">
                        <div class="form-group mb-3">

                            <label class="form-label">
                                CF Pakar
                            </label>

                            <input type="number"
                                class="form-control bg-light"
                                id="nilai"
                                name="nilai"
                                placeholder="0.00"
                                step="0.01"
                                min="-1"
                                max="1"
                                value="{{ old('nilai') }}"
                                readonly>

                            <small class="text-muted">
                                CF Pakar dihitung otomatis menggunakan rumus
                                <b>CF = MB − MD</b>.
                            </small>

                        </div>
                    </div>

                </div>

                {{-- ERROR MESSAGE --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="d-flex justify-content-end gap-2 mt-4">

                    <a href="{{ route('sub_kriteria.index') }}"
                        class="btn btn-danger">
                        Batal
                    </a>

                    <button type="submit"
                        class="btn btn-primary d-flex align-items-center gap-2">

                        <i class="ti ti-device-floppy"></i>
                        Simpan

                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const mb = document.getElementById('mb');
        const md = document.getElementById('md');
        const nilai = document.getElementById('nilai');

        function hitungCF() {

            let mbValue = parseFloat(mb.value);
            let mdValue = parseFloat(md.value);

            if (isNaN(mbValue)) {
                mbValue = 0;
            }

            if (isNaN(mdValue)) {
                mdValue = 0;
            }

            const cfPakar = mbValue - mdValue;

            nilai.value = cfPakar.toFixed(2);
        }

        mb.addEventListener('input', hitungCF);
        md.addEventListener('input', hitungCF);

        hitungCF();

    });
</script>