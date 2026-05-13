<?php

namespace App\Http\Controllers;

use App\Models\DataTraining;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class DataTrainingController extends Controller
{
    public function index()
    {
        $dataTraining = DataTraining::all();

        return view('app', [
            'page' => 'data_training.index',
            'title' => 'Data Training',
            'dataTraining' => $dataTraining
        ]);
    }

    // 🔹 Form tambah
    public function create()
    {
        $subKriteria = SubKriteria::all();

        $warnaKaca = $subKriteria->where('id_kriteria', '1');
        $kebersihan = $subKriteria->where('id_kriteria', '2');
        $ukuran = $subKriteria->where('id_kriteria', '3');
        $kontaminasi = $subKriteria->where('id_kriteria', '4');
        $kelembaban = $subKriteria->where('id_kriteria', '5');

        return view('app', [
            'page' => 'data_training.create',
            'title' => 'Tambah Data Training',
            'warnaKaca' => $warnaKaca,
            'kebersihan' => $kebersihan,
            'ukuran' => $ukuran,
            'kontaminasi' => $kontaminasi,
            'kelembaban' => $kelembaban,
        ]);
    }

    // 🔹 Simpan data
    public function store(Request $request)
    {
        $request->validate([
            'warna_kaca_id' => 'required',
            'kebersihan_id' => 'required',
            'ukuran_id' => 'required',
            'kontaminasi_id' => 'required',
            'kelembaban_id' => 'required',
            'hasil' => 'required',
        ]);

        DataTraining::create($request->all());

        return redirect()->route('data_training.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    // 🔹 Form edit
    public function edit($id)
    {
        $data = DataTraining::findOrFail($id);
        $subKriteria = SubKriteria::all();

        $warnaKaca = $subKriteria->where('id_kriteria', '1');
        $kebersihan = $subKriteria->where('id_kriteria', '2');
        $ukuran = $subKriteria->where('id_kriteria', '3');
        $kontaminasi = $subKriteria->where('id_kriteria', '4');
        $kelembaban = $subKriteria->where('id_kriteria', '5');

        return view('app', [
            'page' => 'data_training.edit',
            'title' => 'Ubah Data Kriteria',
            'data' => $data,
            'warnaKaca' => $warnaKaca,
            'kebersihan' => $kebersihan,
            'ukuran' => $ukuran,
            'kontaminasi' => $kontaminasi,
            'kelembaban' => $kelembaban,
        ]);
    }

    // 🔹 Update data
    public function update(Request $request, $id)
    {
        $data = DataTraining::findOrFail($id);

        $request->validate([
            'warna_kaca_id' => 'required',
            'kebersihan_id' => 'required',
            'ukuran_id' => 'required',
            'kontaminasi_id' => 'required',
            'kelembaban_id' => 'required',
            'hasil' => 'required',
        ]);

        $data->update($request->all());

        return redirect()->route('data_training.index')
            ->with('success', 'Data berhasil diupdate');
    }

    // 🔹 Hapus data
    public function destroy($id)
    {
        $data = DataTraining::findOrFail($id);
        $data->delete();

        return redirect()->route('data_training.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
