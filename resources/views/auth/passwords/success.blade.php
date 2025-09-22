@extends('layouts.auth')

@section('title', 'Password Berhasil Diperbarui')

@section('content')
    <div class="text-center">
        {{-- Ikon ilustrasi sukses --}}
        <div class="mb-4">
            <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-circle"
                 style="width: 100px; height: 100px;">
                <span style="font-size: 50px;">✅</span>
            </div>
        </div>

        {{-- Judul --}}
        <h2 class="fw-bold text-success mb-3">Password Berhasil Diperbarui</h2>

        {{-- Pesan --}}
        <p class="text-muted fs-6">
            Kata sandi akun Anda sudah diganti dengan yang baru.<br>
            Silakan gunakan password baru Anda untuk login berikutnya.
        </p>
    </div>
@endsection
