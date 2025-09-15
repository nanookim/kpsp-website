<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; margin:0;">
<div style="background:#fff; border-radius:10px; padding:30px; max-width:600px; margin:auto;">
    <h2>Halo {{ $name }},</h2>
    <p>Anda menerima email ini karena ada permintaan reset password untuk akun Anda.</p>
    <p>
        <a href="{{ $url }}"
           style="display:inline-block; padding:12px 20px; background:#1d4ed8; color:#ffffff;
                  text-decoration:none; border-radius:5px; font-weight:bold;">
            Reset Password
        </a>
    </p>
    <p>Jika Anda tidak merasa meminta reset password, abaikan email ini.</p>
    <div style="margin-top:30px; font-size:12px; color:#777;">
        <p>Terima kasih,<br>DDTKA Team</p>
    </div>
</div>
</body>
</html>
