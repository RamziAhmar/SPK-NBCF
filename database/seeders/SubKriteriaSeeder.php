<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID Kriteria
        $kriteria = DB::table('kriteria')->pluck('id_kriteria', 'kode_kriteria');

        $data = [

            // K01 - Warna Kaca
            ['id_kriteria' => $kriteria['K01'], 'nama_sub' => 'Bening', 'keterangan' => 'Sangat baik', 'nilai' => 0.8],
            ['id_kriteria' => $kriteria['K01'], 'nama_sub' => 'Sedikit campuran', 'keterangan' => 'Cukup baik', 'nilai' => 0.6],
            ['id_kriteria' => $kriteria['K01'], 'nama_sub' => 'Campuran', 'keterangan' => 'Kurang baik', 'nilai' => 0.4],
            ['id_kriteria' => $kriteria['K01'], 'nama_sub' => 'Gelap/kotor', 'keterangan' => 'Tidak layak', 'nilai' => 0.2],

            // K02 - Kebersihan
            ['id_kriteria' => $kriteria['K02'], 'nama_sub' => 'Sangat bersih', 'keterangan' => 'Tidak ada kotoran', 'nilai' => 0.9],
            ['id_kriteria' => $kriteria['K02'], 'nama_sub' => 'Bersih', 'keterangan' => 'Sedikit kotoran', 'nilai' => 0.7],
            ['id_kriteria' => $kriteria['K02'], 'nama_sub' => 'Kotor', 'keterangan' => 'Banyak kotoran', 'nilai' => 0.4],
            ['id_kriteria' => $kriteria['K02'], 'nama_sub' => 'Sangat kotor', 'keterangan' => 'Tidak layak', 'nilai' => 0.2],

            // K03 - Ukuran
            ['id_kriteria' => $kriteria['K03'], 'nama_sub' => 'Sesuai', 'keterangan' => 'Ideal untuk produksi', 'nilai' => 0.8],
            ['id_kriteria' => $kriteria['K03'], 'nama_sub' => 'Sedang', 'keterangan' => 'Masih layak', 'nilai' => 0.6],
            ['id_kriteria' => $kriteria['K03'], 'nama_sub' => 'Besar', 'keterangan' => 'Kurang baik', 'nilai' => 0.4],
            ['id_kriteria' => $kriteria['K03'], 'nama_sub' => 'Kecil', 'keterangan' => 'Tidak layak', 'nilai' => 0.3],

            // K04 - Kontaminasi
            ['id_kriteria' => $kriteria['K04'], 'nama_sub' => 'Tidak ada', 'keterangan' => 'Sangat aman', 'nilai' => 0.9],
            ['id_kriteria' => $kriteria['K04'], 'nama_sub' => 'Sedikit', 'keterangan' => 'Masih bisa ditoleransi', 'nilai' => 0.7],
            ['id_kriteria' => $kriteria['K04'], 'nama_sub' => 'Ada', 'keterangan' => 'Berisiko', 'nilai' => 0.4],
            ['id_kriteria' => $kriteria['K04'], 'nama_sub' => 'Banyak', 'keterangan' => 'Tidak layak', 'nilai' => 0.1],

            // K05 - Kelembaban
            ['id_kriteria' => $kriteria['K05'], 'nama_sub' => 'Kering', 'keterangan' => 'Ideal', 'nilai' => 0.8],
            ['id_kriteria' => $kriteria['K05'], 'nama_sub' => 'Sedikit lembab', 'keterangan' => 'Masih layak', 'nilai' => 0.6],
            ['id_kriteria' => $kriteria['K05'], 'nama_sub' => 'Lembab', 'keterangan' => 'Kurang baik', 'nilai' => 0.4],
            ['id_kriteria' => $kriteria['K05'], 'nama_sub' => 'Basah', 'keterangan' => 'Tidak layak', 'nilai' => 0.2],
        ];

        DB::table('sub_kriteria')->insert($data);
    }
}
