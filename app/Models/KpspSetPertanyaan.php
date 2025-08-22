<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KpspSetPertanyaan extends Model
{
    use HasFactory;

    protected $table = 'kpsp_set_pertanyaan';

    protected $fillable = [
        'usia_dalam_bulan',
        'deskripsi',
        'jumlah_pertanyaan',
    ];

    public function pertanyaan()
    {
        return $this->hasMany(KpspPertanyaan::class, 'id_set_kpsp');
    }

    public function skrining()
    {
        return $this->hasMany(KpspSkrining::class, 'id_set_kpsp');
    }
}
