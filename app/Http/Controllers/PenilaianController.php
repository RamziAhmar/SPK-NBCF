<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\HasilPerhitungan;
use App\Models\Kriteria;
use App\Models\NilaiAlternatif;
use App\Models\SubKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenilaianController extends Controller
{
    public function index()
    {
        $data = Alternatif::with('hasil')
            ->latest()
            ->get();

        return view('app', [
            'page' => 'penilaian.index',
            'title' => 'Penilaian Alternatif',
            'data' => $data
        ]);
    }

    public function create()
    {
        $kriteria = Kriteria::with('subKriteria')->get();

        return view('app', [
            'page' => 'penilaian.create',
            'title' => 'Input Penilaian',
            'kriteria' => $kriteria
        ]);
    }

    public function store(Request $request)
    {
        // Simpan alternatif
        $alternatif = Alternatif::create([
            'nama_alternatif' => $request->nama_alternatif
        ]);

        $cfCombine = 0;
        $first = true;

        $input = [];

        // Simpan nilai alternatif & hitung CF
        foreach ($request->kriteria as $id_kriteria => $id_sub) {

            $sub = SubKriteria::find($id_sub);

            NilaiAlternatif::create([
                'id_alternatif' => $alternatif->id_alternatif,
                'id_kriteria' => $id_kriteria,
                'id_sub_kriteria' => $id_sub
            ]);

            // mapping ke field dataset
            if ($id_kriteria == 1) $input['warna_kaca_id'] = $id_sub;
            if ($id_kriteria == 2) $input['kebersihan_id'] = $id_sub;
            if ($id_kriteria == 3) $input['ukuran_id'] = $id_sub;
            if ($id_kriteria == 4) $input['kontaminasi_id'] = $id_sub;
            if ($id_kriteria == 5) $input['kelembaban_id'] = $id_sub;

            // CF tetap
            $nilai = $sub->nilai;

            if ($first) {
                $cfCombine = $nilai;
                $first = false;
            } else {
                $cfCombine = $cfCombine + ($nilai * (1 - $cfCombine));
            }
        }

        // Hitung Naive Bayes
        $totalData = DB::table('data_training')->count();

        $totalLayak = DB::table('data_training')
            ->where('hasil', 'Layak')
            ->count();

        $totalTidak = DB::table('data_training')
            ->where('hasil', 'Tidak Layak')
            ->count();

        // prior → pakai log
        $logLayak = log($totalLayak / $totalData);
        $logTidak = log($totalTidak / $totalData);

        foreach ($input as $field => $value) {

            // jumlah kategori (default 4 tiap kriteria)
            $jumlahKategori = 4;

            // Layak
            $countLayak = DB::table('data_training')
                ->where($field, $value)
                ->where('hasil', 'Layak')
                ->count();

            $probLayak = ($countLayak + 1) / ($totalLayak + $jumlahKategori);

            // Tidak Layak
            $countTidak = DB::table('data_training')
                ->where($field, $value)
                ->where('hasil', 'Tidak Layak')
                ->count();

            $probTidak = ($countTidak + 1) / ($totalTidak + $jumlahKategori);

            // tambah log
            $logLayak += log($probLayak);
            $logTidak += log($probTidak);
        }

        // Hasil akhir
        $hasil = $logLayak > $logTidak ? 'Layak' : 'Tidak Layak';

        // Supaya tetap bisa ditampilkan angka
        $expLayak = exp($logLayak);
        $expTidak = exp($logTidak);

        $nilaiNB = $expLayak / ($expLayak + $expTidak);

        // Simpan hasil perhitungan
        HasilPerhitungan::create([
            'id_alternatif' => $alternatif->id_alternatif,
            'nilai_cb' => $nilaiNB,
            'nilai_cf' => $cfCombine,
            'hasil_akhir' => $hasil
        ]);

        return redirect()->route('penilaian.show', $alternatif->id_alternatif);
    }

    public function show($id)
    {
        $data = Alternatif::with('nilaiAlternatif.subKriteria', 'hasil')->findOrFail($id);

        return view('app', [
            'page' => 'penilaian.detail',
            'title' => 'Hasil Penilaian: ' . $data->nama_alternatif,
            'data' => $data
        ]);
    }

    public function destroy($id)
    {
        $alternatif = Alternatif::findOrFail($id);

        // hapus relasi dulu
        NilaiAlternatif::where('id_alternatif', $id)->delete();
        HasilPerhitungan::where('id_alternatif', $id)->delete();

        // hapus utama
        $alternatif->delete();

        return redirect()->route('penilaian.index')->with('success', 'Data berhasil dihapus');
    }
}
