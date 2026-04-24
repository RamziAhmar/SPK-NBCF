<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_training', function (Blueprint $table) {
            $table->id('id_training');

            // FK ke sub_kriteria
            $table->unsignedBigInteger('warna_kaca_id');
            $table->unsignedBigInteger('kebersihan_id');
            $table->unsignedBigInteger('ukuran_id');
            $table->unsignedBigInteger('kontaminasi_id');
            $table->unsignedBigInteger('kelembaban_id');

            // label hasil
            $table->enum('hasil', ['Layak', 'Tidak Layak']);

            $table->timestamps();

            // foreign key
            $table->foreign('warna_kaca_id')->references('id_sub_kriteria')->on('sub_kriteria')->onDelete('cascade');
            $table->foreign('kebersihan_id')->references('id_sub_kriteria')->on('sub_kriteria')->onDelete('cascade');
            $table->foreign('ukuran_id')->references('id_sub_kriteria')->on('sub_kriteria')->onDelete('cascade');
            $table->foreign('kontaminasi_id')->references('id_sub_kriteria')->on('sub_kriteria')->onDelete('cascade');
            $table->foreign('kelembaban_id')->references('id_sub_kriteria')->on('sub_kriteria')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_training');
    }
};
