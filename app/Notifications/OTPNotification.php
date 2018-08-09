<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Bitfumes\KarixNotificationChannel\KarixChannel;
use Bitfumes\KarixNotificationChannel\KarixMessage;
use Illuminate\Contracts\Queue\ShouldQueue;

class OTPNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $via;
    public $OTP;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($via, $OTP)
    {
        $this->via = $via;
        $this->OTP = $OTP;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $this->via == 'sms' ? [KarixChannel::class] : ['mail'];
    }

    public function toKarix($notifiable)
    {
        return KarixMessage::create()
                        ->from('+919907016420')
                        ->content("Your OTP for login is {$this->OTP}");
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->markdown('OTP', ['OTP' => $this->OTP]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
