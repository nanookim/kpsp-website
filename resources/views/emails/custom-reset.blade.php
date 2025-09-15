<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body>
<h2>Reset Password</h2>
<form method="POST" action="{{ url('/api/reset-password') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">

    <label>Password Baru</label><br>
    <input type="password" name="password" required><br><br>

    <label>Konfirmasi Password</label><br>
    <input type="password" name="password_confirmation" required><br><br>

    <button type="submit">Reset Password</button>
</form>
</body>
</html>
