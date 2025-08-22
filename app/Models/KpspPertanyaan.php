<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KpspPertanyaan extends Model
{
    use HasFactory;

    protected $table = 'kpsp_pertanyaan';

    protected $fillable = [
        'id_set_kpsp',
        'teks_pertanyaan',
        'nomor_urut',
        'domain_perkembangan',
        'url_ilustrasi',
    ];

    public function set()
    {
        return $this->belongsTo(KpspSetPertanyaan::class, 'id_set_kpsp');
    }

    public function jawaban()
    {
        return $this->hasMany(KpspJawaban::class, 'id_pertanyaan');
    }
}
