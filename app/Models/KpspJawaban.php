<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KpspJawaban extends Model
{
    use HasFactory;

    protected $table = 'kpsp_jawaban';

    protected $fillable = [
        'id_skrining',
        'id_pertanyaan',
        'jawaban',
    ];

    public function skrining()
    {
        return $this->belongsTo(KpspSkrining::class, 'id_skrining');
    }

    public function pertanyaan()
    {
        return $this->belongsTo(KpspPertanyaan::class, 'id_pertanyaan');
    }
}
