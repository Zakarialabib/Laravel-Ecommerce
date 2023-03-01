<?php

namespace App\Notifications\Admin;

use App\Enums\NotificationType;
use App\Traits\MakeNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable, MakeNotification;

    /**
     * New order instance
     */
    private $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return $this->make([
            'title' => "__('A new order placed')",
            'subtitle' => "__('Customer Name'): {$this->order->customer->name}",
            'link' => "/admin/orders/{$this->order->id}",
            'type' => NotificationType::INFO(),
        ]);
    }
}
