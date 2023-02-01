<?php

namespace App\Listeners;

use App\Models\Notification;
use App\Models\OrderStatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderStatusUpdatedNotification
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

    private function getNewOrderStatusName(int $newOrderStatusId)
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
        $newOrderStatusName = $this->getNewOrderStatusName($event->newOrderStatusId);

        for ($i = 0; $i < 2; $i++) {
            Notification::firstOrCreate([
                'user_id' => $i === 0 ? $event->order->user_id : $event->order->employee_id,
                'description' => "Order ID: {$event->order->id} status changed from {$event->order->status->name} to $newOrderStatusName.",
                'marked_as_read' => false,
                'created_at' => now()
            ]);
        }
    }
}
