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
        $url = config('app.url') . '/reset-password?token=' . $this->token . '&email=' . $this->email;

        return (new MailMessage)
            ->subject('Reset Password Akun Anda')
            ->view('emails.custom-reset', [
                'url'   => $url,
                'name'  => $notifiable->name,
            ]);
    }



}
