<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    protected $table = 'alternatif';
    protected $primaryKey = 'id_alternatif';

    protected $fillable = [
        'nama_alternatif'
    ];

    public function nilaiAlternatif()
    {
        return $this->hasMany(NilaiAlternatif::class, 'id_alternatif');
    }

    public function hasil()
    {
        return $this->hasOne(HasilPerhitungan::class, 'id_alternatif');
    }
}
