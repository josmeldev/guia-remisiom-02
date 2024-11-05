<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PagoPendienteNotification extends Notification
{
    use Queueable;

    private $agricultor;

    public function __construct($agricultor)
    {
        $this->agricultor = $agricultor;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Tienes un pago pendiente para el agricultor ' . $this->agricultor->razon_social)
                    ->line('Monto total a pagar: ' . $this->agricultor->total_a_pagar)
                    ->line('Por favor, realiza el pago lo antes posible.')
                    ->action('Ver detalles', url('/agricultores/' . $this->agricultor->id))
                    ->line('Gracias por usar nuestra aplicación!');
    }

    public function toArray($notifiable)
    {
        return [
            'agricultor_id' => $this->agricultor->id,
            'razon_social' => $this->agricultor->razon_social,
            'total_a_pagar' => $this->agricultor->total_a_pagar,
        ];
    }
}
