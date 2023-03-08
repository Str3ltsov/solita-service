<?php

namespace App\Listeners;

use App\Http\Controllers\PrepareTranslations;
use App\Models\Notification;
use App\Models\NotificationType;
use App\Models\OrderStatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderStatusUpdatedNotification
{
    use PrepareTranslations;

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
        $newOrderStatusName = $this->getNewOrderStatusName($event->newOrderStatusId);

        for ($i = 0; $i < 2; $i++) {
            $notificationArray = [
                'user_id' => $i === 0 ? $event->order->user_id : $event->order->employee_id,
                'notification_type_id' => NotificationType::SYSTEM,
                'description_en' => "Order ID: {$event->order->id} status changed from {$event->order->status->name} to $newOrderStatusName.",
                'description_lt' => "Užsakymo ID: {$event->order->id} būsena pakeista iš {$event->order->status->name} į $newOrderStatusName.",
                'description_ru' => "Заказа ID: {$event->order->id} статус изменился с {$event->order->status->name} на $newOrderStatusName.",
                'marked_as_read' => false,
            ];

            Notification::create($this->prepare($notificationArray, ['description']));
        }
    }
}
