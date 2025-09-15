@component('mail::message')
    # Halo {{ $name }},

    Anda menerima email ini karena ada permintaan reset password untuk akun Anda.

    @component('mail::button', ['url' => $url])
        Reset Password
    @endcomponent

    Jika Anda tidak merasa meminta reset password, abaikan email ini.

    Terima kasih,<br>
    **DDTKA Team**
@endcomponent
