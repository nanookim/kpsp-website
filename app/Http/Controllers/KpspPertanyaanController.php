<?php

namespace App\Http\Controllers;

use App\Exports\KpspPertanyaanTemplateExport;
use App\Models\KpspPertanyaan;
use App\Models\KpspSetPertanyaan;
use Illuminate\Http\Request;
use App\Imports\KpspPertanyaanImport;
use Illuminate\Support\Facades\Storage;
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
            'url_ilustrasi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'id_set_kpsp',
            'nomor_urut',
            'teks_pertanyaan',
            'domain_perkembangan',
        ]);

        if ($request->hasFile('url_ilustrasi')) {
            $path = $request->file('url_ilustrasi')->store('ilustrasi', 'public');
            $data['url_ilustrasi'] = $path;
        }

        KpspPertanyaan::create($data);

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
            'url_ilustrasi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'id_set_kpsp',
            'nomor_urut',
            'teks_pertanyaan',
            'domain_perkembangan',
        ]);

        // Hapus ilustrasi lama jika checkbox dicentang
        if ($request->has('hapus_ilustrasi') && $kpsp_pertanyaan->url_ilustrasi) {
            Storage::delete('public/' . $kpsp_pertanyaan->url_ilustrasi);
            $kpsp_pertanyaan->url_ilustrasi = null;
        }

        // Upload ilustrasi baru jika ada
        if ($request->hasFile('url_ilustrasi')) {
            if ($kpsp_pertanyaan->url_ilustrasi) {
                Storage::delete('public/' . $kpsp_pertanyaan->url_ilustrasi);
            }
            $path = $request->file('url_ilustrasi')->store('ilustrasi', 'public');
            $data['url_ilustrasi'] = $path;
        }

        $kpsp_pertanyaan->update($data);

        return redirect()->route('kpsp-pertanyaan.index')->with('success', 'Pertanyaan berhasil diperbarui');
    }

    public function destroy(KpspPertanyaan $kpsp_pertanyaan)
    {
        if ($kpsp_pertanyaan->url_ilustrasi) {
            Storage::delete('public/' . $kpsp_pertanyaan->url_ilustrasi);
        }

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
