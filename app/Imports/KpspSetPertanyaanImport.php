<?php

namespace App\Imports;

use App\Models\KpspSetPertanyaan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KpspSetPertanyaanImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new KpspSetPertanyaan([
            'usia_dalam_bulan' => $row['usia_dalam_bulan'],
            'deskripsi' => $row['deskripsi'] ?? null,
            'jumlah_pertanyaan' => $row['jumlah_pertanyaan'],
        ]);
    }
}
