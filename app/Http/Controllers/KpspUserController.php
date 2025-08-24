<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KpspSetPertanyaan;
use App\Models\KpspPertanyaan;
use App\Models\KpspJawaban;

class KpspUserController extends Controller
{
    public function index()
    {

        // ambil semua set pertanyaan
        $sets = KpspSetPertanyaan::orderBy('usia_dalam_bulan')->get();

        return view('kpsp.index', compact('sets'));
    }

    public function show($id_set)
    {
        $idAnak = 1; // sementara hardcode

        $set = KpspSetPertanyaan::findOrFail($id_set);
        $pertanyaan = KpspPertanyaan::where('id_set_kpsp', $id_set)
            ->orderBy('nomor_urut')
            ->get();

        // cek skrining terakhir anak untuk set ini
        $skrining = \App\Models\KpspSkrining::where('id_set_kpsp', $id_set)
            ->where('id_anak', $idAnak)
            ->latest('tanggal_skrining')
            ->with('jawaban.pertanyaan')
            ->first();

        return view('kpsp.show', compact('set', 'pertanyaan', 'skrining'));
    }

    private function interpretasi($skor, $jumlahPertanyaan)
    {
        if ($skor == $jumlahPertanyaan) {
            return 'Sesuai';
        } elseif ($skor >= $jumlahPertanyaan - 2) {
            return 'Meragukan';
        } else {
            return 'Penyimpangan';
        }
    }

    public function store(Request $request, $id_set)
    {
        $idAnak = 1;

        // 1. Buat sesi skrining baru
        $skrining = \App\Models\KpspSkrining::create([
            'id_set_kpsp' => $id_set,   // 🔴 pakai nama kolom yang benar
            'id_anak'     => $idAnak,
            'tanggal_skrining'=> now(),
            'skor_mentah'      => 0,   // ✅ default 0 dulu
            'user_id'     => auth()->id() ?? null,
            'hasil_interpretasi' => 'Belum dihitung',
            'tanggal'     => now(),
        ]);

        // 2. Ambil pertanyaan dari set
        $pertanyaan = KpspPertanyaan::where('id_set_kpsp', $id_set)->get();

        // 3. Simpan jawaban
        $skor = 0;
        foreach ($pertanyaan as $p) {
            $jawaban = $request->input("jawaban_{$p->id}");

            if ($jawaban === 'ya') {
                $skor++;
            }

            KpspJawaban::create([
                'id_skrining'   => $skrining->id,
                'id_anak'       => $idAnak,
                'id_pertanyaan' => $p->id,
                'jawaban'       => $jawaban,
                'user_id'       => auth()->id() ?? null,
            ]);
        }
        $skrining->update([
            'skor_mentah'       => $skor,
            'hasil_interpretasi'=> $this->interpretasi($skor, $pertanyaan->count())
        ]);


        return redirect()->route('kpsp.index')->with('success', 'Jawaban berhasil disimpan!');
    }




}
