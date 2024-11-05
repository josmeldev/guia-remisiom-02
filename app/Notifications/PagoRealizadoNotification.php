<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Pago;

class PagoRealizadoNotification extends Notification
{
    use Queueable;

    public $pago;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Pago $pago)
    {
        $this->pago = $pago;
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
        $pendiente = $notifiable->calcularPagoPendiente(); // Método hipotético para calcular el pago pendiente para el agricultor

        return (new MailMessage)
            ->subject('Pago Realizado')
            ->line('Se ha realizado un pago con los siguientes detalles:')
            ->line('Monto: ' . $this->pago->monto)
            ->line('Fecha: ' . $this->pago->created_at)
            ->line('Pagos pendientes: ' . $pendiente)
            ->action('Ver Detalles del Pago', url('/pagos/' . $this->pago->id));
    }
}
