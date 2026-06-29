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

    <h2 class="title">
        Laporan Hasil Analisis Kelayakan Bahan Beling
    </h2>

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
    <h3>Data Penilaian</h3>

    <table>
        <thead>
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

                <td>{{ number_format($n->subKriteria->mb,2) }}</td>

                <td>{{ number_format($n->subKriteria->md,2) }}</td>

                <td>{{ number_format($n->subKriteria->nilai,2) }}</td>

            </tr>

            @endforeach

        </tbody>

    </table>

    <hr>

    {{-- HASIL PERHITUNGAN --}}
    <h3>Hasil Perhitungan Certainty Factor</h3>

    <table style="width:60%">

        <tr>
            <th>Nilai Certainty Factor</th>
            <td>{{ number_format($data->hasil->nilai_cf,4) }}</td>
        </tr>

        <tr>
            <th>Persentase Keyakinan</th>
            <td>{{ number_format($data->hasil->nilai_cf*100,2) }}%</td>
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

        <strong>Interpretasi Hasil</strong>

        <br><br>

        Nilai Certainty Factor menunjukkan tingkat keyakinan sistem terhadap keputusan
        kelayakan bahan beling.

        <br><br>

        @php

        $cf = $data->hasil->nilai_cf;

        @endphp

        @if($cf >= 0.8)

        Sistem memiliki tingkat keyakinan
        <b>Sangat Tinggi</b>
        ({{ number_format($cf*100,2) }}%).

        @elseif($cf >= 0.6)

        Sistem memiliki tingkat keyakinan
        <b>Tinggi</b>
        ({{ number_format($cf*100,2) }}%).

        @elseif($cf >= 0.4)

        Sistem memiliki tingkat keyakinan
        <b>Sedang</b>
        ({{ number_format($cf*100,2) }}%).

        @elseif($cf >= 0.2)

        Sistem memiliki tingkat keyakinan
        <b>Rendah</b>
        ({{ number_format($cf*100,2) }}%).

        @else

        Sistem memiliki tingkat keyakinan
        <b>Sangat Rendah</b>
        ({{ number_format($cf*100,2) }}%).

        @endif

    </div>

    <br><br>

    <table style="border:none">

        <tr style="border:none">

            <td style="border:none">

                Dicetak pada :

                {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}

            </td>

        </tr>

    </table>

</body>

</html>