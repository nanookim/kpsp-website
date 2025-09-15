<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
        .container { background: #fff; border-radius: 10px; padding: 30px; max-width: 600px; margin: auto; }
        .btn { display: inline-block; padding: 12px 20px; background: #1d4ed8; color: #fff; text-decoration: none; border-radius: 5px; }
        .footer { margin-top: 30px; font-size: 12px; color: #777; }
    </style>
</head>
<body>
<div class="container">
    <h2>Halo {{ $name }},</h2>
    <p>Anda menerima email ini karena ada permintaan reset password untuk akun Anda.</p>
    <p>
        <a href="{{ $url }}" class="btn">Reset Password</a>
    </p>
    <p>Jika Anda tidak merasa meminta reset password, abaikan email ini.</p>
    <div class="footer">
        <p>Terima kasih,<br>DDTKA Team</p>
    </div>
</div>
</body>
</html>
