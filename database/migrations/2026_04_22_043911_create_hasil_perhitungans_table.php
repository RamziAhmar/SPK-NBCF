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
        Schema::create('hasil_perhitungan', function (Blueprint $table) {
            $table->id('id_hasil_perhitungan');
            $table->unsignedBigInteger('id_alternatif');
            $table->decimal('nilai_cb', 5, 4)->nullable();
            $table->decimal('nilai_cf', 5, 4)->nullable();
            $table->enum('hasil_akhir', ['Layak', 'Tidak Layak']);
            $table->timestamps();
            
            $table->foreign('id_alternatif')->references('id_alternatif')->on('alternatif')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_perhitungan');
    }
};
