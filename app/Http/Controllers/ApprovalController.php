<?php

namespace App\Http\Controllers;

use App\Models\HasilPerhitungan;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function index()
    {
        $data = HasilPerhitungan::all();

        return view('app', [
            'page' => 'approval.index',
            'title' => 'Approval',
            'data' => $data
        ]);
    }
}
