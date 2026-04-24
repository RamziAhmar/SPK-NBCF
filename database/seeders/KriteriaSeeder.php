<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kriteria')->insert([
            ['kode_kriteria' => 'K01', 'nama_kriteria' => 'Warna Kaca'],
            ['kode_kriteria' => 'K02', 'nama_kriteria' => 'Kebersihan'],
            ['kode_kriteria' => 'K03', 'nama_kriteria' => 'Ukuran Pecahan'],
            ['kode_kriteria' => 'K04', 'nama_kriteria' => 'Kontaminasi Logam'],
            ['kode_kriteria' => 'K05', 'nama_kriteria' => 'Kelembaban'],
        ]);
    }
}
