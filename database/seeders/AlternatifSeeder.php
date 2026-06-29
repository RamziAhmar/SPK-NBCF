<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Alternatif;
use App\Models\SubKriteria;
use App\Models\NilaiAlternatif;
use App\Models\HasilPerhitungan;

class AlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ambil mapping kode_kriteria ke id_kriteria dari database
        $kriteriaMap = DB::table('kriteria')->pluck('id_kriteria', 'kode_kriteria');

        // 2. Definisikan data dummy berdasarkan Nama Sub Kriteria (sesuai Seeder Anda)
        $dummyData = [
            [
                'nama_alternatif' => 'PT. Sinar Kaca Mulia',
                'penilaian' => [
                    'K01' => 'Bening',
                    'K02' => 'Sangat Bersih',
                    'K03' => 'Sesuai',
                    'K04' => 'Tidak Ada',
                    'K05' => 'Kering',
                ]
            ],
            [
                'nama_alternatif' => 'UD. Sumber Gelas Plastik',
                'penilaian' => [
                    'K01' => 'Campuran',
                    'K02' => 'Kotor',
                    'K03' => 'Besar',
                    'K04' => 'Ada',
                    'K05' => 'Lembab',
                ]
            ],
            [
                'nama_alternatif' => 'Pengepul Kaca Sejahtera',
                'penilaian' => [
                    'K01' => 'Sedikit Campuran',
                    'K02' => 'Bersih',
                    'K03' => 'Sedang',
                    'K04' => 'Sedikit',
                    'K05' => 'Sedikit Lembab',
                ]
            ],
        ];

        // 3. Looping data alternatif
        foreach ($dummyData as $data) {

            // Simpan alternatif baru
            $alternatif = Alternatif::create([
                'nama_alternatif' => $data['nama_alternatif']
            ]);

            $cfCombine = 0;
            $first = true;

            // Looping berdasarkan penilaian kriteria
            foreach ($data['penilaian'] as $kode_kriteria => $nama_sub) {

                // Dapatkan id_kriteria dari map
                $id_kriteria = $kriteriaMap[$kode_kriteria] ?? null;

                if (!$id_kriteria) {
                    continue; // Skip jika kode kriteria tidak terdaftar
                }

                // Cari data sub kriteria berdasarkan id_kriteria dan nama_sub (kolom sesuai seeder Anda)
                $sub = SubKriteria::where('id_kriteria', $id_kriteria)
                    ->where('nama_sub', $nama_sub)
                    ->first();

                if (!$sub) {
                    continue; // Skip jika nama sub kriteria salah ketik / tidak ditemukan
                }

                // Simpan ke tabel nilai_alternatif
                NilaiAlternatif::create([
                    'id_alternatif'   => $alternatif->id_alternatif,
                    'id_kriteria'     => $id_kriteria,
                    'id_sub_kriteria' => $sub->id_sub_kriteria
                ]);

                /*
                |--------------------------------------------------------------------------
                | Perhitungan Certainty Factor
                |--------------------------------------------------------------------------
                */
                $cf = $sub->mb - $sub->md;

                if ($first) {
                    $cfCombine = $cf;
                    $first = false;
                } else {
                    $cfCombine = $cfCombine + ($cf * (1 - $cfCombine));
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Menentukan hasil akhir & status ENUM yang valid
            |--------------------------------------------------------------------------
            */
            if ($cfCombine >= 0.80) {
                $hasil = 'Layak';
                $status = 'Disetujui'; // Menyesuaikan enum: Menunggu/Ditolak/Disetujui
            } else {
                $hasil = 'Tidak Layak';
                $status = 'Ditolak';   // Menyesuaikan enum: Menunggu/Ditolak/Disetujui
            }

            /*
            |--------------------------------------------------------------------------
            | Simpan hasil perhitungan
            |--------------------------------------------------------------------------
            */
            HasilPerhitungan::create([
                'id_alternatif' => $alternatif->id_alternatif,
                'nilai_cf'      => round($cfCombine, 4),
                'nilai_cb'      => null, // Diisi null terlebih dahulu sesuai skema nullable
                'hasil_akhir'   => $hasil,
                'status'        => $status
            ]);
        }
    }
}
