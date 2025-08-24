<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class KpspPertanyaanTemplateExport implements FromArray
{
    public function array(): array
    {
        return [
            ['set_id', 'nomor_urut', 'teks_pertanyaan', 'domain_perkembangan', 'url_ilustrasi'],
        ];
    }
}
