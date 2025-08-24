<?php

namespace App\Http\Controllers;

use App\Models\KpspSkrining;
use App\Models\Child;
use App\Models\KpspSetPertanyaan;
use Illuminate\Http\Request;

class KpspSkriningController extends Controller
{
    public function index()
    {
        $skrining = KpspSkrining::with(['anak', 'set'])
            ->orderBy('tanggal_skrining', 'desc')
            ->paginate(10);

        return view('kpsp_skrining.index', compact('skrining'));
    }

    public function create()
    {
        $children = Child::orderBy('name')->get();
        $sets = KpspSetPertanyaan::orderBy('usia_dalam_bulan')->get();

        return view('kpsp_skrining.create', compact('children', 'sets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_anak' => 'required|exists:children,id',
            'id_set_kpsp' => 'required|exists:kpsp_set_pertanyaan,id',
            'tanggal_skrining' => 'required|date',
            'skor_mentah' => 'required|integer',
            'hasil_interpretasi' => 'required|string|max:50',
            'rekomendasi' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        KpspSkrining::create($request->all());

        return redirect()->route('kpsp-skrining.index')->with('success', 'Skrining berhasil ditambahkan');
    }

    public function edit(KpspSkrining $kpsp_skrining)
    {
        $children = Child::orderBy('name')->get();
        $sets = KpspSetPertanyaan::orderBy('usia_dalam_bulan')->get();

        return view('kpsp_skrining.edit', compact('kpsp_skrining', 'children', 'sets'));
    }

    public function update(Request $request, KpspSkrining $kpsp_skrining)
    {
        $request->validate([
            'id_anak' => 'required|exists:children,id',
            'id_set_kpsp' => 'required|exists:kpsp_set_pertanyaan,id',
            'tanggal_skrining' => 'required|date',
            'skor_mentah' => 'required|integer',
            'hasil_interpretasi' => 'required|string|max:50',
            'rekomendasi' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        $kpsp_skrining->update($request->all());

        return redirect()->route('kpsp-skrining.index')->with('success', 'Skrining berhasil diperbarui');
    }

    public function destroy(KpspSkrining $kpsp_skrining)
    {
        $kpsp_skrining->delete();
        return redirect()->route('kpsp-skrining.index')->with('success', 'Skrining berhasil dihapus');
    }
}
