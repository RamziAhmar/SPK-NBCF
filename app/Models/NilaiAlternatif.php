<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiAlternatif extends Model
{
    protected $table = 'nilai_alternatif';
    protected $primaryKey = 'id_nilai_alternatif';

    protected $fillable = [
        'id_alternatif',
        'id_kriteria',
        'id_sub_kriteria'
    ];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'id_alternatif');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    }

    public function subKriteria()
    {
        return $this->belongsTo(SubKriteria::class, 'id_sub_kriteria');
    }
}
