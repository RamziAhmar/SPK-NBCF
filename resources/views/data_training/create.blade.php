<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('data_training.store') }}">
                @csrf

                <div class="form-group mb-3">
                    <label class="form-label">Warna Kaca</label>
                    <select class="form-control" name="warna_kaca_id" required>
                        <option>Pilih Warna Kaca</option>
                        @foreach ($warnaKaca as $item)
                            <option value="{{ $item->id_sub_kriteria }}"
                                {{ old('id_sub_kriteria') == $item->nama_sub ? 'selected' : '' }}>
                                {{ $item->nama_sub }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Kebersihan</label>
                    <select class="form-control" name="kebersihan_id" required>
                        <option>Pilih Kebersihan</option>
                        @foreach ($kebersihan as $item)
                            <option value="{{ $item->id_sub_kriteria }}"
                                {{ old('id_sub_kriteria') == $item->nama_sub ? 'selected' : '' }}>
                                {{ $item->nama_sub }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Ukuran Pecahan</label>
                    <select class="form-control" name="ukuran_id" required>
                        <option>Pilih Ukuran Pecahan</option>
                        @foreach ($ukuran as $item)
                            <option value="{{ $item->id_sub_kriteria }}"
                                {{ old('id_sub_kriteria') == $item->nama_sub ? 'selected' : '' }}>
                                {{ $item->nama_sub }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Kontaminasi Logam</label>
                    <select class="form-control" name="kontaminasi_id" required>
                        <option>Pilih Kontaminasi Logam</option>
                        @foreach ($kontaminasi as $item)
                            <option value="{{ $item->id_sub_kriteria }}"
                                {{ old('id_sub_kriteria') == $item->nama_sub ? 'selected' : '' }}>
                                {{ $item->nama_sub }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Kelembaban</label>
                    <select class="form-control" name="kelembaban_id" required>
                        <option>Pilih Kelembaban</option>
                        @foreach ($kelembaban as $item)
                            <option value="{{ $item->id_sub_kriteria }}"
                                {{ old('id_sub_kriteria') == $item->nama_sub ? 'selected' : '' }}>
                                {{ $item->nama_sub }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Hasil</label>
                    <select class="form-control" name="hasil" required>
                        <option>Pilih Hasil</option>
                        <option value="Layak">Layak</option>
                        <option value="Tidak Layak">Tidak layak</option>
                    </select>
                </div>

                {{-- ERROR MESSAGE --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="d-flex justify-content-end gap-2 mt-4">

                    <a href="{{ route('data_training.index') }}" class="btn btn-danger">
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
