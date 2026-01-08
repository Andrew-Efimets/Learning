<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Product;
use App\Services\EmailSenderService;

class OrdersObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        if($order->status === 1){
            $product = Product::with('user')
            ->where('order_number', $order->order_number)
            ->get();
            foreach ($product as $item) {
                EmailSenderService::sendBuyProductMail($item);
            }
        }
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
