<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;
    public $email;

    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // URL API/Flutter untuk reset password
        $url = config('kpsp.himogi.my.id') . '/reset-password?token=' . $this->token . '&email=' . $this->email;

        return (new MailMessage)
            ->subject('Reset Password Akun Anda')
            ->greeting('Halo ' . $notifiable->name . ',')
            ->line('Anda menerima email ini karena ada permintaan reset password untuk akun Anda.')
            ->action('Reset Password', $url)
            ->line('Jika Anda tidak merasa meminta reset password, abaikan email ini.');
    }
}
