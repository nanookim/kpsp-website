@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Reset Password</h2>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label>Email</label>
                <input type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus>
            </div>

            <div>
                <label>Password Baru</label>
                <input type="password" name="password" required>
            </div>

            <div>
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <button type="submit">Reset Password</button>
        </form>
    </div>
@endsection
