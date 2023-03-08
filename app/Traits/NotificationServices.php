<?php

namespace App\Traits;

use App\Models\Notification;
use App\Models\NotificationType;

trait NotificationServices
{
    public function getNotificationsByUserId(int $userId, ?int $notificationType = null, bool $markedAsRead = false): object
    {
        $notification = Notification::where('user_id', $userId)
            ->where('marked_as_read', $markedAsRead);

        $notificationType && $notification = $notification->where('notification_type_id', $notificationType);

        return $notification->orderBy('created_at', 'desc')->paginate(10);
    }

    public function getNotificationById(int $id)
    {
        return Notification::find($id);
    }

    public function getNotificationNumber(object $notifications): int
    {
        return count($notifications);
    }
}
