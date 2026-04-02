<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomOrderReviewed extends Notification
{
    use Queueable;

    protected $order;
    protected $statusMessage;
    protected $adminNotes;

    public function __construct($order, $statusMessage, $adminNotes = null)
    {
        $this->order = $order;
        $this->statusMessage = $statusMessage;
        $this->adminNotes = $adminNotes;
    }

    public function via(object $notifiable): array
    {
        return ['database']; // Hanya database untuk bell icon
    }

    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'order_code' => $this->order->order_code,
            'status_message' => $this->statusMessage, // ex: Disetujui, Ditolak
            'admin_notes' => $this->adminNotes,
            'price' => $this->order->price > 0 ? $this->order->price : null
        ];
    }
}
