<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::all();

        return view('app', [
            'page' => 'kriteria.index',
            'title' => 'Data Kriteria',
            'kriteria' => $kriteria
        ]);
    }

    // 🔹 Form tambah
    public function create()
    {
        return view('app', [
            'page' => 'kriteria.create',
            'title' => 'Tambah Data Kriteria',
        ]);
    }

    // 🔹 Simpan data
    public function store(Request $request)
    {
        $request->validate([
            'kode_kriteria' => 'required|unique:kriteria,kode_kriteria',
            'nama_kriteria' => 'required'
        ]);

        Kriteria::create($request->all());

        return redirect()->route('kriteria.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    // 🔹 Form edit
    public function edit($id)
    {
        $data = Kriteria::findOrFail($id);

        return view('app', [
            'page' => 'kriteria.edit',
            'title' => 'Ubah Data Kriteria: ' . $data->nama_kriteria,
            'data' => $data
        ]);
    }

    // 🔹 Update data
    public function update(Request $request, $id)
    {
        $data = Kriteria::findOrFail($id);

        $request->validate([
            'kode_kriteria' => 'required|unique:kriteria,kode_kriteria,' . $id . ',id_kriteria',
            'nama_kriteria' => 'required'
        ]);

        $data->update($request->all());

        return redirect()->route('kriteria.index')
            ->with('success', 'Data berhasil diupdate');
    }

    // 🔹 Hapus data
    public function destroy($id)
    {
        $data = Kriteria::findOrFail($id);
        $data->delete();

        return redirect()->route('kriteria.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
