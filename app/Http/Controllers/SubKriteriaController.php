<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    public function index(Request $request)
    {
        $kriteria = Kriteria::all();

        $query = SubKriteria::query();

        // cek apakah ada filter
        if ($request->kriteria_id) {
            $query->where('id_kriteria', $request->kriteria_id);
        }

        $subKriteria = $query->get();

        return view('app', [
            'page' => 'sub_kriteria.index',
            'title' => 'Data Sub Kriteria',
            'subKriteria' => $subKriteria,
            'kriteria' => $kriteria
        ]);
    }

    // 🔹 Form tambah
    public function create()
    {
        $kriteria = Kriteria::all();
        return view('app', [
            'page' => 'sub_kriteria.create',
            'title' => 'Tambah Data Sub Kriteria',
            'kriteria' => $kriteria
        ]);
    }

    // 🔹 Simpan data
    public function store(Request $request)
    {
        $request->validate([
            'id_kriteria' => 'required|exists:kriteria,id_kriteria',
            'nama_sub' => 'required',
            'keterangan' => 'required',
            'nilai' => 'required|decimal:1|min:0|max:1'
        ]);

        SubKriteria::create($request->all());

        return redirect()->route('sub_kriteria.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    // 🔹 Form edit
    public function edit($id)
    {
        $data = SubKriteria::findOrFail($id);
        $kriteria = Kriteria::all();
        return view('app', [
            'page' => 'sub_kriteria.edit',
            'title' => 'Ubah Data Sub Kriteria: ' . $data->nama_sub,
            'data' => $data,
            'kriteria' => $kriteria
        ]);
    }

    // 🔹 Update data
    public function update(Request $request, $id)
    {
        $data = SubKriteria::findOrFail($id);

        $request->validate([
            'id_kriteria' => 'required|exists:kriteria,id_kriteria',
            'nama_sub' => 'required',
            'keterangan' => 'required',
            'nilai' => 'required|decimal:1|min:0|max:1'
        ]);

        $data->update($request->all());

        return redirect()->route('sub_kriteria.index')
            ->with('success', 'Data berhasil diupdate');
    }

    // 🔹 Hapus data
    public function destroy($id)
    {
        $data = SubKriteria::findOrFail($id);
        $data->delete();

        return redirect()->route('sub_kriteria.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
