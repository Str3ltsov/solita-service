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

    private array $translatedStatusNames;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->translatedStatusNames = [
            1 => __('forms.created'),
            2 => __('forms.preview'),
            3 => __('forms.previewed'),
            4 => __('forms.approvedByClient'),
            5 => __('forms.approvedByManager'),
            6 => __('forms.running'),
            7 => __('forms.completed'),
            8 => __('forms.overdue'),
            9 => __('forms.cancelled')
        ];
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

        for ($j = 0; $j < 2; $j++) {
            $notificationArray = [
                'user_id' => $j === 0 ? $event->order->user_id : $event->order->employee_id,
                'notification_type_id' => NotificationType::SYSTEM,
                'description_en' => "Order ID: {$event->order->id} status changed from {$event->order->status->name} to $newOrderStatusName.",
                'description_lt' => "Užsakymo ID: {$event->order->id} būsena pakeista iš {$this->translatedStatusNames[$event->order->status_id]} į {$this->translatedStatusNames[$event->newOrderStatusId]}",
                'marked_as_read' => false,
            ];

            Notification::create($this->prepare($notificationArray, ['description']));
        }
    }
}
