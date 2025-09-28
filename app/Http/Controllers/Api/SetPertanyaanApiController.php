<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Imports\KpspSetPertanyaanImport;
use App\Models\KpspJawaban;
use App\Models\KpspPertanyaan;
use App\Models\KpspSetPertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class SetPertanyaanApiController extends Controller
{
    public function index(Request $request)
    {
        $idAnak = $request->get('id_anak');
        if (!$idAnak) {
            return response()->json([
                'success' => false,
                'message' => 'Anak belum dipilih'
            ], 400);
        }
        $sets = KpspSetPertanyaan::orderBy('usia_dalam_bulan')
            ->get()
            ->map(function ($set) use ($idAnak) {
                $skrining = \App\Models\KpspSkrining::where('id_set_kpsp', $set->id)
                    ->where('id_anak', $idAnak)
                    ->latest('tanggal_skrining')
                    ->first();

                return [
                    'id' => $set->id,
                    'usia_dalam_bulan' => $set->usia_dalam_bulan,
                    'deskripsi' => $set->deskripsi,
                    'url_ilustrasi' => $set->url_ilustrasi,
                    'jumlah_pertanyaan' => $set->jumlah_pertanyaan,
                    'skrining_terakhir' => $skrining ? $skrining->tanggal_skrining : null,
                ];
            });

        return response()->json([
            'success' => true,
            'message' => 'Daftar set pertanyaan',
            'data' => $sets,
        ]);
    }

    public function show($id_set)
    {
        $idAnak = 1; // sementara hardcode

        $set = KpspSetPertanyaan::findOrFail($id_set);

        // ambil pertanyaan sesuai set
        $pertanyaan = KpspPertanyaan::where('id_set_kpsp', $id_set)
            ->orderBy('nomor_urut')
            ->get()
            ->map(function ($p) {
                // Perbaiki baris ini untuk membuat URL publik yang benar
                $baseUrl = 'https://kpsp.himogi.my.id/';
                $urlIlustrasi = $p->url_ilustrasi
                    ? $baseUrl . 'storage/' . $p->url_ilustrasi
                    : null;

                return [
                    'id' => $p->id,
                    'nomor_urut' => $p->nomor_urut,
                    'teks_pertanyaan' => $p->teks_pertanyaan,
                    'domain_perkembangan' => $p->domain_perkembangan,
                    'url_ilustrasi' => $urlIlustrasi, // Gunakan URL yang sudah diperbaiki
                ];
            });


        // optional: ambil skrining terakhir anak
        $skrining = \App\Models\KpspSkrining::where('id_set_kpsp', $id_set)
            ->where('id_anak', $idAnak)
            ->latest('tanggal_skrining')
            ->with('jawaban.pertanyaan')
            ->first();

        return response()->json([
            'success' => true,
            'message' => 'Detail set pertanyaan',
            'data' => [
                'set' => $set,
                'pertanyaan' => $pertanyaan,
                'skrining_terakhir' => $skrining,
            ],
        ]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'usia_dalam_bulan' => 'required|integer|unique:kpsp_set_pertanyaan,usia_dalam_bulan',
            'deskripsi' => 'nullable|string',
            'jumlah_pertanyaan' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $set = KpspSetPertanyaan::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Set pertanyaan berhasil ditambahkan',
            'data' => $set
        ]);
    }

    public function update(Request $request, KpspSetPertanyaan $kpsp_set)
    {
        $validator = Validator::make($request->all(), [
            'usia_dalam_bulan' => 'required|integer|unique:kpsp_set_pertanyaan,usia_dalam_bulan,' . $kpsp_set->id,
            'deskripsi' => 'nullable|string',
            'jumlah_pertanyaan' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $kpsp_set->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Set pertanyaan berhasil diperbarui',
            'data' => $kpsp_set
        ]);
    }

    public function destroy(KpspSetPertanyaan $kpsp_set)
    {
        $kpsp_set->delete();

        return response()->json([
            'success' => true,
            'message' => 'Set pertanyaan berhasil dihapus'
        ]);
    }

    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        Excel::import(new KpspSetPertanyaanImport(), $request->file('file'));

        return response()->json([
            'success' => true,
            'message' => 'Data set pertanyaan berhasil diimport'
        ]);
    }

    private function interpretasi($skor)
    {
        if ($skor >= 9) {
            return 'Sesuai';
        } elseif ($skor >= 7) {
            return 'Meragukan';
        } else {
            return 'Penyimpangan';
        }
    }

    private function kesimpulan($skor, $detailTidak)
    {
        $hasil = $this->interpretasi($skor);

        // cari domain mana yang paling bermasalah
        $max = max($detailTidak);
        $domainBermasalah = [];
        if ($max > 0) {
            $domainBermasalah = array_keys($detailTidak, $max);
        }

        $kesimpulan = "Perkembangan anak: {$hasil}. ";

        if ($hasil === 'Sesuai') {
            $kesimpulan .= "Tidak ada keterlambatan yang menonjol.";
        } elseif ($hasil === 'Meragukan') {
            $kesimpulan .= "Perlu pemantauan ulang dalam 1–2 minggu. ";
            if (!empty($domainBermasalah)) {
                $kesimpulan .= "Bidang yang perlu diperhatikan: " . implode(', ', $domainBermasalah) . ".";
            }
        } else { // Penyimpangan
            $kesimpulan .= "Ditemukan kemungkinan penyimpangan perkembangan. ";
            if (!empty($domainBermasalah)) {
                $kesimpulan .= "Bidang dengan hambatan: " . implode(', ', $domainBermasalah) . ".";
            }
            $kesimpulan .= " Disarankan rujukan untuk pemeriksaan lebih lanjut.";
        }

        return $kesimpulan;
    }

    public function submitJawaban(Request $request, $id_set)
    {
        $id_anak = $request->input('id_anak');

        $request->validate([
            'jawaban' => 'required|array',
            'jawaban.*' => 'required|in:ya,tidak',
        ]);

        // buat skrining baru
        $skrining = \App\Models\KpspSkrining::create([
            'id_set_kpsp' => $id_set,
            'id_anak' => $id_anak,
            'tanggal_skrining' => now(),
            'skor_mentah' => 0,
            'user_id' => auth()->id() ?? null,
            'hasil_interpretasi' => 'Belum dihitung',
            'tanggal' => now(),
        ]);

        $skor = 0;

        // inisialisasi counter per domain
        $detailTidak = [
            'gerak_kasar' => 0,
            'gerak_halus' => 0,
            'bicara_bahasa' => 0,
            'sosialisasi_kemandirian' => 0,
        ];

        foreach ($request->jawaban as $idPertanyaan => $jawaban) {
            $pertanyaan = KpspPertanyaan::find($idPertanyaan);

            if ($jawaban === 'ya') {
                $skor++;
            } else {
                if ($pertanyaan && array_key_exists($pertanyaan->domain_perkembangan, $detailTidak)) {
                    $detailTidak[$pertanyaan->domain_perkembangan]++;
                }

            }

            KpspJawaban::create([
                'id_skrining' => $skrining->id,
                'id_pertanyaan' => $idPertanyaan,
                'jawaban' => $jawaban,
            ]);
        }

        $hasil = $this->interpretasi($skor);
        $kesimpulan = $this->kesimpulan($skor, $detailTidak);

        $skrining->update([
            'skor_mentah' => $skor,
            'hasil_interpretasi' => $hasil,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Jawaban berhasil disimpan',
            'data' => [
                'skrining' => $skrining,
                'detail_tidak' => $detailTidak,
                'kesimpulan' => $kesimpulan,
                'interpretasi' => $hasil,
                'skor' => $skor,
                'rekomendasi' => $kesimpulan,
            ],
        ]);
    }

    public function riwayat($id_anak)
    {
        $skrining = \App\Models\KpspSkrining::where('id_anak', $id_anak)
            ->orderBy('tanggal_skrining', 'desc')
            ->with(['set', 'jawaban.pertanyaan'])
            ->get()
            ->map(function ($s) {
                $detailTidak = [
                    'gerak_kasar' => 0,
                    'gerak_halus' => 0,
                    'bicara_bahasa' => 0,
                    'sosialisasi_kemandirian' => 0,
                ];

                foreach ($s->jawaban as $j) {
                    if ($j->jawaban === 'tidak' && $j->pertanyaan) {
                        $domain = $j->pertanyaan->domain_perkembangan;
                        if (array_key_exists($domain, $detailTidak)) {
                            $detailTidak[$domain]++;
                        }
                    }
                }

                $kesimpulan = $this->kesimpulan($s->skor_mentah, $detailTidak);

                return [
                    'id' => $s->id,
                    'tanggal_skrining'   => $s->tanggal_skrining,   // ✅ konsisten
                    'usia_set'           => $s->set->usia_dalam_bulan ?? null,
                    'deskripsi_set'      => $s->set->deskripsi ?? null,
                    'skor_mentah'        => $s->skor_mentah,        // ✅ konsisten
                    'hasil_interpretasi' => $s->hasil_interpretasi, // ✅ konsisten
                    'kesimpulan'         => $kesimpulan,
                ];
            });

        return response()->json([
            'success' => true,
            'message' => 'Riwayat skrining anak',
            'data' => $skrining,
        ]);
    }

    public function getJawaban($id_set, Request $request) {
        $id_anak = $request->query('id_anak');
        $skrining = KpspSkrining::where('id_set_kpsp', $id_set)
            ->where('id_anak', $id_anak)
            ->latest('tanggal_skrining')
            ->with('jawaban.pertanyaan')
            ->first();

        if (!$skrining) {
            return response()->json([
                'success' => true,
                'data' => []
            ]);
        }

        $jawaban = $skrining->jawaban->map(function($j){
            return [
                'id_pertanyaan' => $j->id_pertanyaan,
                'jawaban' => $j->jawaban,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $jawaban,
        ]);
    }

}
