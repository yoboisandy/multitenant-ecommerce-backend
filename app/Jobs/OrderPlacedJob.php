<?php

namespace App\Jobs;

use App\Models\Order;
use App\Notifications\OrderPlacedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class OrderPlacedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Order $order)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $orderProducts = $this->order->orderProducts;

        // decrement product quantity
        foreach ($orderProducts as $orderProduct) {
            $orderProduct->product->decrement('quantity', $orderProduct->quantity);
        }

        // send notification
        Notification::route('mail', $this->order->customer_email)
            ->notify(new OrderPlacedNotification($this->order));
    }
}
