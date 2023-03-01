<?php

namespace App\Trait;

use App\Enums\NotificationType;
use Carbon\Carbon;
use Illuminate\Notifications\Messages\BroadcastMessage;

trait MakeNotification
{
    /**
     * Make the notification for databse
     *
     * @param  array  $payload
     *
     * @return array
     */
    public function make($payload)
    {
        return [
            'title' => $payload['title'],
            'subtitle' => $payload['subtitle'] ?? null,
            'link' => $payload['link'] ?? null,
            // "data"     => $payload['data'] ?? null,
            'type' => $payload['type'] ?? NotificationType::INFO(),
            // 'icon'     => $payload['icon'] ?? 'fas fa-info'
        ];
    }

    /**
     * Make the notification for broadcast
     *
     * @param  mixed  $notifiable
     *
     * @return array
     */
    public function toBroadcast($notifiable)
    {
        $timestamp = Carbon::now()->addSecond()->toDateTimeString();
        return new BroadcastMessage([
            'id' => $this->id,
            'notifiable_id' => $notifiable->id,
            'notifiable_type' => $notifiable::class,
            'data' => $this->toArray($notifiable),
            'read_at' => null,
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ]);
    }
}
