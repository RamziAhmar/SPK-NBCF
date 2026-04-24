<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilPerhitungan extends Model
{
    protected $table = 'hasil_perhitungan';
    protected $primaryKey = 'id_hasil_perhitungan';

    protected $fillable = [
        'id_alternatif',
        'nilai_cb',
        'nilai_cf',
        'hasil_akhir'
    ];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'id_alternatif');
    }
}
