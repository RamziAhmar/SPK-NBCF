<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\HasilPerhitungan;
use App\Models\Kriteria;
use App\Models\NilaiAlternatif;
use App\Models\SubKriteria;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenilaianController extends Controller
{
    public function index()
    {
        $data = Alternatif::whereDoesntHave('hasil', function ($query) {
            $query->where('status', 'Menunggu');
        })->with('hasil')->latest()->get();

        $dataMenunggu = Alternatif::whereHas('hasil', function ($query) {
            $query->where('status', 'Menunggu');
        })->with('hasil')->latest()->get();

        return view('app', [
            'page' => 'penilaian.index',
            'title' => 'Penilaian Alternatif',
            'data' => $data,
            'dataMenunggu' => $dataMenunggu,
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
        $request->validate([
            'nama_alternatif' => 'required',
            'kriteria' => 'required|array'
        ]);

        // Simpan alternatif
        $alternatif = Alternatif::create([
            'nama_alternatif' => $request->nama_alternatif
        ]);

        $cfCombine = 0;
        $first = true;

        foreach ($request->kriteria as $id_kriteria => $id_sub) {

            $sub = SubKriteria::findOrFail($id_sub);

            // Simpan nilai alternatif
            NilaiAlternatif::create([
                'id_alternatif'   => $alternatif->id_alternatif,
                'id_kriteria'     => $id_kriteria,
                'id_sub_kriteria' => $id_sub
            ]);

            /*
        |--------------------------------------------------------------------------
        | Perhitungan Certainty Factor
        |--------------------------------------------------------------------------
        */

            // Hitung CF tiap evidence
            $cf = $sub->mb - $sub->md;

            // Kombinasi CF
            if ($first) {

                $cfCombine = $cf;
                $first = false;
            } else {

                $cfCombine = $cfCombine + ($cf * (1 - $cfCombine));
            }
        }

        /*
    |--------------------------------------------------------------------------
    | Menentukan hasil akhir
    |--------------------------------------------------------------------------
    */

        if ($cfCombine >= 0.80) {

            $hasil = 'Layak';
        } else {

            $hasil = 'Tidak Layak';
        }

        /*
    |--------------------------------------------------------------------------
    | Simpan hasil
    |--------------------------------------------------------------------------
    */
        HasilPerhitungan::create([
            'id_alternatif' => $alternatif->id_alternatif,
            'nilai_cf'      => round($cfCombine, 4),
            'hasil_akhir'   => $hasil,
            'status'        => 'Menunggu'
        ]);

        return redirect()->route('penilaian.show', $alternatif->id_alternatif)
            ->with('success', 'Penilaian berhasil dilakukan.');
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

    public function exportPdf($id)
    {
        $data = Alternatif::with([
            'hasil',
            'nilaiAlternatif.kriteria',
            'nilaiAlternatif.subKriteria'
        ])->findOrFail($id);

        $pdf = Pdf::loadView('penilaian.pdf', compact('data'));

        return $pdf->download('hasil-analisis.pdf');

        // kalau ingin preview di browser:
        // return $pdf->stream('hasil-analisis.pdf');
    }
}
