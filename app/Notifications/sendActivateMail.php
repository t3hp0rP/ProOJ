<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class sendActivateMail extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * User's id
     *
     * @var $uid
     */
    public $uid;

    /**
     * User's ActiveCode
     *
     * @var $activeCode
     */
    public $activeCode;
    /**
     * Create a new notification instance.
     *
     * @param $uid
     * @param $activeCode
     *
     * @return void
     */
    public function __construct($uid, $activeCode)
    {
        $this->uid = $uid;
        $this->activeCode = $activeCode;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                    ->line('Activate your Pro OJ account now!')
                    ->action('Activate', URL( 'activation' ,array('uid' => $this->uid, 'activeCode' => $this->activeCode)))
                    ->line('Thank you for using Pro OJ!');
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
