<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\HasilPerhitungan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $total = Alternatif::count();

        $layak = HasilPerhitungan::where('hasil_akhir', 'Layak')->count();
        $tidak = HasilPerhitungan::where('hasil_akhir', 'Tidak Layak')->count();

        $training = DB::table('data_training')->count();

        $recent = Alternatif::with('hasil')->latest()->limit(5)->get();

        return view('app', [
            'page' => 'dashboard.index',
            'title' => 'Dashboard',
            'total' => $total,
            'layak' => $layak,
            'tidak' => $tidak,
            'training' => $training,
            'recent' => $recent,
        ]);
    }
}
