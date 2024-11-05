<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PagoProximoNotification extends Notification
{
    use Queueable;

    protected $agricultores;

    public function __construct($agricultores)
    {
        $this->agricultores = $agricultores;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'agricultores' => $this->agricultores,
        ];
    }
}
