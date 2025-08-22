<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . ($pengguna->id ?? 'NULL'),
            'password' => [
                $request->isMethod('post') ? 'required' : 'nullable',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'
            ],
        ]);


        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return response()->json(['message' => 'User berhasil dibuat', 'data' => $user], 201);
    }

    public function show(User $pengguna)
    {
        return response()->json($pengguna);
    }

    public function update(Request $request, User $pengguna)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $pengguna->id,
            'password' => 'nullable|min:8',
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $pengguna->update($data);

        return response()->json(['message' => 'User berhasil diperbarui', 'data' => $pengguna]);
    }

    public function destroy(User $pengguna)
    {
        $pengguna->delete();

        return response()->json(['message' => 'User berhasil dihapus']);
    }
    // 🔹 Tambahkan method login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email atau password salah'
            ], 401);
        }

        // Token sederhana, bisa diganti dengan Sanctum/Passport nanti
        $token = base64_encode($user->id . ':' . now());

        return response()->json([
            'message' => 'Login berhasil',
            'token'   => $token,
            'user'    => $user
        ]);
    }
}
