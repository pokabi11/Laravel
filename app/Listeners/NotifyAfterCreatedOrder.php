<?php

namespace App\Listeners;

use App\Events\NewOrderCreated;
use App\Mail\MailOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Pusher\Pusher;

class NotifyAfterCreatedOrder
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
     * @param  \App\Events\NewOrderCreated  $event
     * @return void
     */
    public function handle(NewOrderCreated $event)
    {
        $order = $event->order;
        session()->forget("cart");

//         notification pusher
        $data['message'] = 'Có 1 đơn hàng mới, bạn có muốn tải lại trang?';
        $data["confirm"] = true;
        notify("my-channel","my-event",$data);

        Mail::to($order->email)->send(new MailOrder($order));
    }
}
