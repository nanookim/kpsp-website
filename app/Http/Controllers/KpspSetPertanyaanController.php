<?php

namespace App\Http\Controllers;

use App\Imports\KpspSetPertanyaanImport;
use App\Models\KpspSetPertanyaan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KpspSetPertanyaanController extends Controller
{
    public function index()
    {
        $sets = KpspSetPertanyaan::orderBy('usia_dalam_bulan')->paginate(10);
        return view('kpsp_set.index', compact('sets'));
    }

    public function create()
    {
        return view('kpsp_set.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'usia_dalam_bulan' => 'required|integer|unique:kpsp_set_pertanyaan,usia_dalam_bulan',
            'deskripsi' => 'nullable|string',
            'jumlah_pertanyaan' => 'required|integer',
        ]);

        KpspSetPertanyaan::create($request->all());

        return redirect()->route('kpsp-set.index')->with('success', 'Set pertanyaan berhasil ditambahkan');
    }

    public function edit(KpspSetPertanyaan $kpsp_set)
    {
        return view('kpsp_set.edit', compact('kpsp_set'));
    }

    public function update(Request $request, KpspSetPertanyaan $kpsp_set)
    {
        $request->validate([
            'usia_dalam_bulan' => 'required|integer|unique:kpsp_set_pertanyaan,usia_dalam_bulan,' . $kpsp_set->id,
            'deskripsi' => 'nullable|string',
            'jumlah_pertanyaan' => 'required|integer',
        ]);

        $kpsp_set->update($request->all());

        return redirect()->route('kpsp-set.index')->with('success', 'Set pertanyaan berhasil diperbarui');
    }

    public function destroy(KpspSetPertanyaan $kpsp_set)
    {
        $kpsp_set->delete();
        return redirect()->route('kpsp-set.index')->with('success', 'Set pertanyaan berhasil dihapus');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new KpspSetPertanyaanImport(), $request->file('file'));

        return redirect()->route('kpsp-set.index')->with('success', 'Data set pertanyaan berhasil diimport');
    }
}
