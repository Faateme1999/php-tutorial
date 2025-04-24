<?php

namespace Fateme\User\Notifications;

use Fateme\User\Mail\ResetPasswordRequestMail;
use Fateme\User\Services\VerifyCodeService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ResetPasswordRequestNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
//        return ['mail','sms','telegram'];
//        $notifiable ye instance az userie k sabtenam karde
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $code = VerifyCodeService::generate();

        VerifyCodeService::store($notifiable->id, $code, time:120);

        return (new ResetPasswordRequestMail($code))
            ->to($notifiable->email);
    }

//    public function toTelegram(object $notifiable)
//    {
//    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

}
