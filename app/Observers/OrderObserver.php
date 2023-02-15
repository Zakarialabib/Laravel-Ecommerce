<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Admin\NewOrderNotification;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        // Notify the admin users
        $users = User::all();
        Notification::send($users, new NewOrderNotification($order));
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        // if ($order->isDirty('status')) {
        //     $order->orderLogs()->create([
        //         'action'      => "updated",
        //         'attribute'   => "status",
        //         'old_value'   => $order->getOriginal('status'),
        //         'new_value'   => $order->status,
        //         'description' => "Order status changed from " . Str::upper($order->getOriginal('status')) . " to " . Str::upper($order->status),
        //     ]);
        // }
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}