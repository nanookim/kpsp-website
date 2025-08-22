<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KpspSkrining extends Model
{
    use HasFactory;

    protected $table = 'kpsp_skrining';

    protected $fillable = [
        'id_anak',
        'id_set_kpsp',
        'tanggal_skrining',
        'skor_mentah',
        'hasil_interpretasi',
        'rekomendasi',
        'catatan',
    ];

    protected $casts = [
        'tanggal_skrining' => 'date',
    ];

    public function anak()
    {
        return $this->belongsTo(Child::class, 'id_anak');
    }

    public function set()
    {
        return $this->belongsTo(KpspSetPertanyaan::class, 'id_set_kpsp');
    }

    public function jawaban()
    {
        return $this->hasMany(KpspJawaban::class, 'id_skrining');
    }
}
