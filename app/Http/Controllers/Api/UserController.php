<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    // 🔹 Ambil semua user (admin)
    public function index()
    {
        return response()->json([
            'success' => true,
            'users' => User::all()
        ]);
    }

    // 🔹 Register user baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
        ]);

        $user = User::create([
            'name' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dibuat',
            'user' => $user
        ], 201);
    }

    // 🔹 Detail user
    public function show(User $pengguna)
    {
        return response()->json([
            'success' => true,
            'user' => $pengguna
        ]);
    }

    // 🔹 Update user
    public function update(Request $request, User $pengguna)
    {
        $data = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $pengguna->id,
            'password' => 'nullable|string|min:8',
        ]);

        $updateData = [
            'name' => $data['username'],
            'email' => $data['email'],
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $pengguna->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'User berhasil diperbarui',
            'user' => $pengguna
        ]);
    }

    // 🔹 Hapus user
    public function destroy(User $pengguna)
    {
        $pengguna->delete();

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dihapus'
        ]);
    }

    // 🔹 Login user (Sanctum)
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password salah.'],
            ]);
        }

        // Buat token Sanctum
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'username' => $user->name,
                'email' => $user->email,
            ]
        ]);
    }

    // 🔹 Logout (revoke token)
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil'
        ]);
    }
}
