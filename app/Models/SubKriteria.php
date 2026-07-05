<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    protected $table = 'sub_kriteria';
    protected $primaryKey = 'id_sub_kriteria';

    protected $fillable = [
        'id_kriteria',
        'nama_sub',
        'keterangan',
        'md',
        'mb',
        'nilai'
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    }

    public function nilaiAlternatif()
    {
        return $this->hasMany(NilaiAlternatif::class, 'id_sub_kriteria');
    }
}
