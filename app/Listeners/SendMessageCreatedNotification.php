<?php

namespace App\Listeners;

use App\Http\Controllers\PrepareTranslations;
use App\Models\Notification;
use App\Models\NotificationType;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMessageCreatedNotification
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

    private function setAndGetUserIds(object $messageUsers): array
    {
        $userIds = [];

        foreach ($messageUsers as $messageUser) {
            $userIds[] = $messageUser->user_id;
        }

        return $userIds;
    }

    private function createUserNotifications(array $userIds, string $senderName, string $orderName): void
    {
        foreach ($userIds as $userId) {
            $notificationArray = [
                'user_id' => $userId,
                'notification_type_id' => NotificationType::USER,
                'description_en' => "A new message has been sent to you from $senderName, regarding order: $orderName",
                'description_lt' => "Iš $senderName jums buvo išsiųstas naujas pranešimas dėl užsakymo: $orderName",
                'description_ru' => "Вам отправлено новое сообщение от $senderName относительно заказа: $orderName",
                'marked_as_read' => false,
            ];

            Notification::create($this->prepare($notificationArray, ['description']));
        }
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $userIds = $this->setAndGetUserIds($event->users);

        $this->createUserNotifications($userIds, $event->sender->name, $event->order->name);
    }
}
