<?php

namespace App\Http\Controllers;

use App\Models\HasilPerhitungan;

class ApprovalController extends Controller
{
    public function index()
    {
        $data = HasilPerhitungan::all();

        $menunggu = $data->where('status', 'Menunggu');

        return view('app', [
            'page' => 'approval.index',
            'title' => 'Approval',
            'data' => $data,
        ]);
    }

    public function approved($id)
    {
        $data = HasilPerhitungan::findOrFail($id);


        $data->update(['status' => 'Disetujui']);

        return redirect()->route('approval.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function rejected($id)
    {
        $data = HasilPerhitungan::findOrFail($id);


        $data->update(['status' => 'Ditolak']);

        return redirect()->route('approval.index')
            ->with('success', 'Data berhasil diupdate');
    }
}
