<?php

namespace Fateme\User\Notifications;

use Fateme\User\Mail\VerifyCodeMail;
use Fateme\User\Services\VerifyCodeService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyMailNotification extends Notification
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

        VerifyCodeService::store($notifiable->id, $code);

        return (new VerifyCodeMail($notifiable, $code))
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
