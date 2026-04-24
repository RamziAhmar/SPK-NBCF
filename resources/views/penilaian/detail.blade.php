<div class="col-sm-12">
    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="mb-0">Hasil Analisis Kelayakan Bahan Baku</h4>

                <a href="{{ route('penilaian.index') }}" class="btn btn-danger d-flex align-items-center gap-2">
                    <i class="ti ti-arrow-left"></i>
                    Kembali
                </a>
            </div>

            {{-- IDENTITAS --}}
            <div class="mb-3">
                <strong>Nama Alternatif :</strong> {{ $data->nama_alternatif }}
            </div>

            <hr>

            {{-- TABEL KRITERIA --}}
            <h5 class="mb-3">Data Kriteria</h5>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kriteria</th>
                            <th>Sub Kriteria</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->nilaiAlternatif as $n)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $n->kriteria->nama_kriteria }}</td>
                                <td>{{ $n->subKriteria->nama_sub }}</td>
                                <td>{{ $n->subKriteria->nilai }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <hr>

            {{-- HASIL PERHITUNGAN --}}
            <h5 class="mb-3">Hasil Perhitungan</h5>

            <table class="table table-bordered w-50">
                <tr>
                    <th>Metode Naive Bayes</th>
                    <td>{{ number_format($data->hasil->nilai_cb, 4) }}</td>
                </tr>
                <tr>
                    <th>Certainty Factor</th>
                    <td>{{ number_format($data->hasil->nilai_cf, 4) }}</td>
                </tr>
            </table>

            <hr>

            {{-- KESIMPULAN --}}
            <h5 class="mb-3">Kesimpulan</h5>

            <div class="mb-3">
                <strong>Hasil Kelayakan :</strong>
                <span class="badge bg-{{ $data->hasil->hasil_akhir == 'Layak' ? 'success' : 'danger' }}">
                    {{ $data->hasil->hasil_akhir }}
                </span>
            </div>

            {{-- INTERPRETASI --}}
            <div class="alert alert-info mt-3">
                <strong>Interpretasi:</strong><br>

                Keputusan kelayakan ditentukan menggunakan metode <b>Naive Bayes</b>
                berdasarkan probabilitas dari data training.

                Nilai <b>Certainty Factor</b> menunjukkan tingkat keyakinan sistem terhadap hasil tersebut.

                <br><br>

                @if ($data->hasil->nilai_cf >= 0.8)
                    Tingkat keyakinan sistem <b>tinggi</b>.
                @elseif($data->hasil->nilai_cf >= 0.6)
                    Tingkat keyakinan sistem <b>cukup</b>.
                @else
                    Tingkat keyakinan sistem <b>rendah</b>.
                @endif
            </div>

        </div>
    </div>
</div>
