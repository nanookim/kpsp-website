@extends('layouts.app')

@section('content')
    <div class="container text-center" style="margin-top:100px;">
        <h2 style="color: green;">✅ Password Berhasil Diperbarui</h2>
        <p>Kata sandi akun Anda telah berhasil diubah.</p>

        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Kembali ke Halaman Utama</a>
    </div>
@endsection
