<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class CommonNotification extends Notification
{
    use Queueable;

    private $title;
    private $message;
    private $link;

    /**
     * Create a new notification instance.
     * @param  string  $message
     * @param  string  $link
     * @return void
     */
    public function __construct($title, $message, $link)
    {
        $this->title = $title;
        $this->message = $message;
        $this->link = $link;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'link' => $this->link,
        ];
    }


}
