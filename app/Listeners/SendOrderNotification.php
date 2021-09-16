<?php

namespace App\Listeners;

use App\Events\OrderSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendOrderNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderSent  $event
     * @return void
     */
    public function handle(OrderSent $event)
    {
        Log::info('Order has been sent id:' . $event->order->id);
    }
}
