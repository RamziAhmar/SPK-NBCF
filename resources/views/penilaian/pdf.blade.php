<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Hasil Analisis</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 8px;
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
        }

        .badge-success {
            background: #198754;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
        }

        .badge-danger {
            background: #dc3545;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
        }

        .alert-info {
            background: #cff4fc;
            padding: 10px;
            margin-top: 15px;
            border: 1px solid #b6effb;
        }
    </style>
</head>

<body>

    <h2 class="title">Hasil Analisis Kelayakan Bahan Baku</h2>

    {{-- IDENTITAS --}}
    <div>
        <strong>Nama Alternatif :</strong>
        {{ $data->nama_alternatif }}
    </div>

    <br>

    <div>
        <strong>Status Approval :</strong>

        <span class="{{ $data->hasil->status == 'Disetujui' ? 'badge-success' : 'badge-danger' }}">
            {{ $data->hasil->status }}
        </span>
    </div>

    <hr>

    {{-- TABEL KRITERIA --}}
    <h3>Data Kriteria</h3>

    <table>
        <thead>
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

    <hr>

    {{-- HASIL --}}
    <h3>Hasil Perhitungan</h3>

    <table style="width:50%">
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
    <h3>Kesimpulan</h3>

    <div>
        <strong>Hasil Kelayakan :</strong>

        <span class="{{ $data->hasil->hasil_akhir == 'Layak' ? 'badge-success' : 'badge-danger' }}">
            {{ $data->hasil->hasil_akhir }}
        </span>
    </div>

    {{-- INTERPRETASI --}}
    <div class="alert-info">
        <strong>Interpretasi:</strong><br><br>

        Keputusan kelayakan ditentukan menggunakan metode
        <b>Naive Bayes</b>
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

</body>

</html>
