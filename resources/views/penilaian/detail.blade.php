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

            <div class="mb-3">
                <strong>Status Approval : </strong><span
                    class="badge bg-{{ $data->hasil->status == 'Disetujui' ? 'success' : 'danger' }}">
                    {{ $data->hasil->status }} </span>
            </div>

            <hr>

            {{-- TABEL KRITERIA --}}
            <h5 class="mb-3">Data Kriteria</h5>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Kriteria</th>
                            <th>Sub Kriteria</th>
                            <th>MB</th>
                            <th>MD</th>
                            <th>CF Pakar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->nilaiAlternatif as $n)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $n->kriteria->nama_kriteria }}</td>
                            <td>{{ $n->subKriteria->nama_sub }}</td>
                            <td class="text-center">{{ number_format($n->subKriteria->mb,2) }}</td>
                            <td class="text-center">{{ number_format($n->subKriteria->md,2) }}</td>
                            <td class="text-center">{{ number_format($n->subKriteria->nilai,2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <hr>

            {{-- HASIL PERHITUNGAN --}}
            <h5 class="mb-3">Hasil Perhitungan Certainty Factor</h5>

            <table class="table table-bordered w-50">
                <tr>
                    <th width="50%">Nilai Certainty Factor</th>
                    <td>{{ number_format($data->hasil->nilai_cf,4) }}</td>
                </tr>

                <tr>
                    <th>Persentase Keyakinan</th>
                    <td>{{ number_format($data->hasil->nilai_cf * 100,2) }} %</td>
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

                <h6><b>Interpretasi Hasil</b></h6>

                Sistem menentukan tingkat keyakinan kelayakan bahan beling menggunakan metode
                <b>Certainty Factor (CF)</b>.

                Nilai Certainty Factor menunjukkan tingkat keyakinan sistem terhadap hasil keputusan
                yang diberikan.

                <hr>

                @php
                $cf = $data->hasil->nilai_cf;
                @endphp

                @if($cf >= 0.8)

                <b>Tingkat Keyakinan :</b> Sangat Tinggi
                ({{ number_format($cf*100,2) }}%)

                @elseif($cf >= 0.6)

                <b>Tingkat Keyakinan :</b> Tinggi
                ({{ number_format($cf*100,2) }}%)

                @elseif($cf >= 0.4)

                <b>Tingkat Keyakinan :</b> Sedang
                ({{ number_format($cf*100,2) }}%)

                @elseif($cf >= 0.2)

                <b>Tingkat Keyakinan :</b> Rendah
                ({{ number_format($cf*100,2) }}%)

                @else

                <b>Tingkat Keyakinan :</b> Sangat Rendah
                ({{ number_format($cf*100,2) }}%)

                @endif

            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('penilaian.exportPdf', $data->id_alternatif) }}" class="btn btn-primary"
                    target="_blank">
                    Export PDF
                </a>
            </div>
        </div>
    </div>
</div>