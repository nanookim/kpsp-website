<?php

namespace App\Http\Controllers;

use App\Models\KpspJawaban;
use App\Models\KpspSkrining;
use App\Models\KpspPertanyaan;
use Illuminate\Http\Request;

class KpspJawabanController extends Controller
{
    public function index()
    {
        $jawaban = KpspJawaban::with(['skrining.anak', 'pertanyaan.set'])
            ->orderBy('id_skrining')
            ->paginate(15);

        return view('kpsp_jawaban.index', compact('jawaban'));
    }

    public function create()
    {
        $skrining = KpspSkrining::with('anak')->orderBy('tanggal_skrining', 'desc')->get();
        $pertanyaan = KpspPertanyaan::with('set')->orderBy('id_set_kpsp')->orderBy('nomor_urut')->get();

        return view('kpsp_jawaban.create', compact('skrining', 'pertanyaan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_skrining' => 'required|exists:kpsp_skrining,id',
            'id_pertanyaan' => 'required|exists:kpsp_pertanyaan,id',
            'jawaban' => 'required|boolean',
        ]);

        KpspJawaban::create($request->all());

        return redirect()->route('kpsp-jawaban.index')->with('success', 'Jawaban berhasil ditambahkan');
    }

    public function edit(KpspJawaban $kpsp_jawaban)
    {
        $skrining = KpspSkrining::with('anak')->get();
        $pertanyaan = KpspPertanyaan::with('set')->get();

        return view('kpsp_jawaban.edit', compact('kpsp_jawaban', 'skrining', 'pertanyaan'));
    }

    public function update(Request $request, KpspJawaban $kpsp_jawaban)
    {
        $request->validate([
            'id_skrining' => 'required|exists:kpsp_skrining,id',
            'id_pertanyaan' => 'required|exists:kpsp_pertanyaan,id',
            'jawaban' => 'required|boolean',
        ]);

        $kpsp_jawaban->update($request->all());

        return redirect()->route('kpsp-jawaban.index')->with('success', 'Jawaban berhasil diperbarui');
    }

    public function destroy(KpspJawaban $kpsp_jawaban)
    {
        $kpsp_jawaban->delete();
        return redirect()->route('kpsp-jawaban.index')->with('success', 'Jawaban berhasil dihapus');
    }
}
