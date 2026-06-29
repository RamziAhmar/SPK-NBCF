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

            // =====================================================
            // C1 - Warna Kaca
            // =====================================================
            [
                'id_kriteria' => $kriteria['K01'],
                'nama_sub' => 'Bening',
                'keterangan' => 'Sangat baik',
                'mb' => 0.8,
                'md' => 0.0,
                'nilai' => 0.8,
            ],
            [
                'id_kriteria' => $kriteria['K01'],
                'nama_sub' => 'Sedikit Campuran',
                'keterangan' => 'Cukup baik',
                'mb' => 0.6,
                'md' => 0.2,
                'nilai' => 0.4,
            ],
            [
                'id_kriteria' => $kriteria['K01'],
                'nama_sub' => 'Campuran',
                'keterangan' => 'Kurang baik',
                'mb' => 0.4,
                'md' => 0.5,
                'nilai' => -0.1,
            ],
            [
                'id_kriteria' => $kriteria['K01'],
                'nama_sub' => 'Gelap/Kotor',
                'keterangan' => 'Tidak layak',
                'mb' => 0.2,
                'md' => 0.8,
                'nilai' => -0.6,
            ],

            // =====================================================
            // C2 - Kebersihan
            // =====================================================
            [
                'id_kriteria' => $kriteria['K02'],
                'nama_sub' => 'Sangat Bersih',
                'keterangan' => 'Tidak ada kotoran',
                'mb' => 0.9,
                'md' => 0.0,
                'nilai' => 0.9,
            ],
            [
                'id_kriteria' => $kriteria['K02'],
                'nama_sub' => 'Bersih',
                'keterangan' => 'Sedikit kotoran',
                'mb' => 0.7,
                'md' => 0.2,
                'nilai' => 0.5,
            ],
            [
                'id_kriteria' => $kriteria['K02'],
                'nama_sub' => 'Kotor',
                'keterangan' => 'Banyak kotoran',
                'mb' => 0.4,
                'md' => 0.5,
                'nilai' => -0.1,
            ],
            [
                'id_kriteria' => $kriteria['K02'],
                'nama_sub' => 'Sangat Kotor',
                'keterangan' => 'Tidak layak',
                'mb' => 0.2,
                'md' => 0.8,
                'nilai' => -0.6,
            ],

            // =====================================================
            // C3 - Ukuran Pecahan
            // =====================================================
            [
                'id_kriteria' => $kriteria['K03'],
                'nama_sub' => 'Sesuai',
                'keterangan' => 'Ideal untuk produksi',
                'mb' => 0.8,
                'md' => 0.0,
                'nilai' => 0.8,
            ],
            [
                'id_kriteria' => $kriteria['K03'],
                'nama_sub' => 'Sedang',
                'keterangan' => 'Masih layak',
                'mb' => 0.6,
                'md' => 0.2,
                'nilai' => 0.4,
            ],
            [
                'id_kriteria' => $kriteria['K03'],
                'nama_sub' => 'Besar',
                'keterangan' => 'Kurang baik',
                'mb' => 0.4,
                'md' => 0.5,
                'nilai' => -0.1,
            ],
            [
                'id_kriteria' => $kriteria['K03'],
                'nama_sub' => 'Kecil',
                'keterangan' => 'Tidak layak',
                'mb' => 0.2,
                'md' => 0.8,
                'nilai' => -0.6,
            ],

            // =====================================================
            // C4 - Kontaminasi
            // =====================================================
            [
                'id_kriteria' => $kriteria['K04'],
                'nama_sub' => 'Tidak Ada',
                'keterangan' => 'Sangat aman',
                'mb' => 0.9,
                'md' => 0.0,
                'nilai' => 0.9,
            ],
            [
                'id_kriteria' => $kriteria['K04'],
                'nama_sub' => 'Sedikit',
                'keterangan' => 'Masih bisa ditoleransi',
                'mb' => 0.6,
                'md' => 0.2,
                'nilai' => 0.4,
            ],
            [
                'id_kriteria' => $kriteria['K04'],
                'nama_sub' => 'Ada',
                'keterangan' => 'Berisiko',
                'mb' => 0.4,
                'md' => 0.6,
                'nilai' => -0.2,
            ],
            [
                'id_kriteria' => $kriteria['K04'],
                'nama_sub' => 'Banyak',
                'keterangan' => 'Tidak layak',
                'mb' => 0.1,
                'md' => 0.9,
                'nilai' => -0.8,
            ],

            // =====================================================
            // C5 - Kelembaban
            // =====================================================
            [
                'id_kriteria' => $kriteria['K05'],
                'nama_sub' => 'Kering',
                'keterangan' => 'Ideal',
                'mb' => 0.8,
                'md' => 0.0,
                'nilai' => 0.8,
            ],
            [
                'id_kriteria' => $kriteria['K05'],
                'nama_sub' => 'Sedikit Lembab',
                'keterangan' => 'Masih layak',
                'mb' => 0.6,
                'md' => 0.3,
                'nilai' => 0.3,
            ],
            [
                'id_kriteria' => $kriteria['K05'],
                'nama_sub' => 'Lembab',
                'keterangan' => 'Kurang baik',
                'mb' => 0.4,
                'md' => 0.6,
                'nilai' => -0.2,
            ],
            [
                'id_kriteria' => $kriteria['K05'],
                'nama_sub' => 'Basah',
                'keterangan' => 'Tidak layak',
                'mb' => 0.1,
                'md' => 0.9,
                'nilai' => -0.8,
            ],
        ];

        DB::table('sub_kriteria')->insert($data);
    }
}
