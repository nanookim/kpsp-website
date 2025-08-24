<?php

namespace App\Http\Controllers;

use App\Exports\KpspPertanyaanTemplateExport;
use App\Models\KpspPertanyaan;
use App\Models\KpspSetPertanyaan;
use Illuminate\Http\Request;
use App\Imports\KpspPertanyaanImport;
use Maatwebsite\Excel\Facades\Excel;
class KpspPertanyaanController extends Controller
{
    public function index()
    {
        $pertanyaan = KpspPertanyaan::with('set')->orderBy('id_set_kpsp')->orderBy('nomor_urut')->paginate(10);
        return view('kpsp_pertanyaan.index', compact('pertanyaan'));
    }

    public function create()
    {
        $sets = KpspSetPertanyaan::orderBy('usia_dalam_bulan')->get();
        return view('kpsp_pertanyaan.create', compact('sets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_set_kpsp' => 'required|exists:kpsp_set_pertanyaan,id',
            'teks_pertanyaan' => 'required|string',
            'nomor_urut' => 'required|integer',
            'domain_perkembangan' => 'nullable|string|max:50',
            'url_ilustrasi' => 'nullable|string|max:255',
        ]);

        KpspPertanyaan::create($request->all());

        return redirect()->route('kpsp-pertanyaan.index')->with('success', 'Pertanyaan berhasil ditambahkan');
    }

    public function edit(KpspPertanyaan $kpsp_pertanyaan)
    {
        $sets = KpspSetPertanyaan::orderBy('usia_dalam_bulan')->get();
        return view('kpsp_pertanyaan.edit', compact('kpsp_pertanyaan', 'sets'));
    }

    public function update(Request $request, KpspPertanyaan $kpsp_pertanyaan)
    {
        $request->validate([
            'id_set_kpsp' => 'required|exists:kpsp_set_pertanyaan,id',
            'teks_pertanyaan' => 'required|string',
            'nomor_urut' => 'required|integer',
            'domain_perkembangan' => 'nullable|string|max:50',
            'url_ilustrasi' => 'nullable|string|max:255',
        ]);

        $kpsp_pertanyaan->update($request->all());

        return redirect()->route('kpsp-pertanyaan.index')->with('success', 'Pertanyaan berhasil diperbarui');
    }

    public function destroy(KpspPertanyaan $kpsp_pertanyaan)
    {
        $kpsp_pertanyaan->delete();
        return redirect()->route('kpsp-pertanyaan.index')->with('success', 'Pertanyaan berhasil dihapus');
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,xls']);

        Excel::import(new KpspPertanyaanImport, $request->file('file'));

        return redirect()->back()->with('success', 'Pertanyaan berhasil diimport!');
    }

    public function template()
    {
        return Excel::download(new KpspPertanyaanTemplateExport(), 'template_import_pertanyaan.xlsx');
    }
}
