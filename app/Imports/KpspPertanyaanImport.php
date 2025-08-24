<?php
namespace App\Imports;

use App\Models\KpspPertanyaan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KpspPertanyaanImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new KpspPertanyaan([
            'id_set_kpsp'       => $row['set_id'], // mapping
            'nomor_urut'        => $row['nomor_urut'],
            'teks_pertanyaan'   => $row['teks_pertanyaan'],
            'domain_perkembangan' => $row['domain_perkembangan'] ?? null,
            'url_ilustrasi'     => $row['url_ilustrasi'] ?? null,
        ]);
    }
}

