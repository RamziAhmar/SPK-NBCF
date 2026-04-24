<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataTrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            // =====================
            // DATA LAYAK
            // =====================
            [
                'warna_kaca_id' => 1, // bening
                'kebersihan_id' => 5, // sangat bersih
                'ukuran_id' => 9, // sesuai
                'kontaminasi_id' => 13, // tidak ada
                'kelembaban_id' => 17, // kering
                'hasil' => 'Layak'
            ],
            [
                'warna_kaca_id' => 2,
                'kebersihan_id' => 6,
                'ukuran_id' => 10,
                'kontaminasi_id' => 14,
                'kelembaban_id' => 18,
                'hasil' => 'Layak'
            ],
            [
                'warna_kaca_id' => 1,
                'kebersihan_id' => 6,
                'ukuran_id' => 9,
                'kontaminasi_id' => 13,
                'kelembaban_id' => 18,
                'hasil' => 'Layak'
            ],

            // =====================
            // DATA TIDAK LAYAK
            // =====================
            [
                'warna_kaca_id' => 4, // gelap
                'kebersihan_id' => 8, // sangat kotor
                'ukuran_id' => 12, // kecil
                'kontaminasi_id' => 16, // banyak
                'kelembaban_id' => 20, // basah
                'hasil' => 'Tidak Layak'
            ],
            [
                'warna_kaca_id' => 3,
                'kebersihan_id' => 7,
                'ukuran_id' => 11,
                'kontaminasi_id' => 15,
                'kelembaban_id' => 19,
                'hasil' => 'Tidak Layak'
            ],
            [
                'warna_kaca_id' => 4,
                'kebersihan_id' => 7,
                'ukuran_id' => 11,
                'kontaminasi_id' => 16,
                'kelembaban_id' => 20,
                'hasil' => 'Tidak Layak'
            ],

        ];

        // duplikasi biar banyak (simulasi dataset besar)
        $final = [];

        for ($i = 0; $i < 10; $i++) {
            foreach ($data as $d) {
                $final[] = $d;
            }
        }

        DB::table('data_training')->insert($final);
    }
}
