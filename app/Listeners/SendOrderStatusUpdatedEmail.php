<?php

namespace App\Listeners;

use App\Mail\OrderStatusUpdated;
use App\Models\OrderStatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderStatusUpdatedEmail
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

    private function getNewOrderStatusName(int $newOrderStatusId): string
    {
        return OrderStatus::select('id', 'name')
            ->where('id', $newOrderStatusId)
            ->value('name');
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Mail::to($event->order->user->email)->send(new OrderStatusUpdated(
            $event->order->user->email,
            $event->order->user->name,
            $event->order->id,
            $event->order->status->name,
            $this->getNewOrderStatusName($event->newOrderStatusId)
        ));
        Mail::to($event->order->employee->email)->send(new OrderStatusUpdated(
            $event->order->employee->email,
            $event->order->employee->name,
            $event->order->id,
            $event->order->status->name,
            $this->getNewOrderStatusName($event->newOrderStatusId)
        ));
    }
}
