<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Child;
use Illuminate\Http\Request;

class ChildApiController extends Controller
{
    // 🔹 Ambil semua anak untuk user yang login
    public function index(Request $request)
    {
        $children = $request->user()->children()->get(); // sekarang akan pakai id_user

        return response()->json([
            'success' => true,
            'children' => $children
        ]);
    }


    // 🔹 Simpan anak baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'birth_history' => 'required|in:normal,premature',
        ]);

        $child = $request->user()->children()->create($data);

        return response()->json([
            'success' => true,
            'message' => 'Data anak berhasil disimpan',
            'child' => $child
        ], 201);
    }

    // 🔹 Detail anak
    public function show($id, Request $request)
    {
        $child = $request->user()->children()->findOrFail($id);

        return response()->json([
            'success' => true,
            'child' => $child
        ]);
    }

    // 🔹 Update anak
    public function update(Request $request, $id)
    {
        $child = $request->user()->children()->findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'birth_history' => 'required|in:normal,premature',
        ]);

        $child->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Data anak berhasil diperbarui',
            'child' => $child
        ]);
    }

    // 🔹 Hapus anak
    public function destroy($id, Request $request)
    {
        $child = $request->user()->children()->findOrFail($id);
        $child->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data anak berhasil dihapus'
        ]);
    }
}
