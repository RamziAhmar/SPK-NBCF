<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataTraining extends Model
{
    protected $table = 'data_training';
    protected $primaryKey = 'id_training';

    protected $fillable = [
        'warna_kaca_id',
        'kebersihan_id',
        'ukuran_id',
        'kontaminasi_id',
        'kelembaban_id',
        'hasil',
    ];

    public function warnaKaca()
    {
        return $this->belongsTo(SubKriteria::class, 'warna_kaca_id', 'id_sub_kriteria');
    }

    public function kebersihan()
    {
        return $this->belongsTo(SubKriteria::class, 'kebersihan_id', 'id_sub_kriteria');
    }

    public function ukuran()
    {
        return $this->belongsTo(SubKriteria::class, 'ukuran_id', 'id_sub_kriteria');
    }

    public function kontaminasi()
    {
        return $this->belongsTo(SubKriteria::class, 'kontaminasi_id', 'id_sub_kriteria');
    }

    public function kelembaban()
    {
        return $this->belongsTo(SubKriteria::class, 'kelembaban_id', 'id_sub_kriteria');
    }
}
