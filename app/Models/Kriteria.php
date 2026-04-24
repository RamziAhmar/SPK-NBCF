<?php

namespace App\Models;

use App\Models\NilaiAlternatif;
use App\Models\SubKriteria;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'kriteria';
    protected $primaryKey = 'id_kriteria';

    protected $fillable = [
        'kode_kriteria',
        'nama_kriteria'
    ];

    public function subKriteria()
    {
        return $this->hasMany(SubKriteria::class, 'id_kriteria');
    }

    public function nilaiAlternatif()
    {
        return $this->hasMany(NilaiAlternatif::class, 'id_kriteria');
    }
}
