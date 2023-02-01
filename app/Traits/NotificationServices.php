<?php

namespace App\Traits;

use App\Models\Notification;

trait NotificationServices
{
    public function getUnreadNotificationsByUserId(int $userId): object
    {
        return Notification::where('user_id', $userId)
            ->where('marked_as_read', false)
            ->paginate(10);
    }

    public function getReadNotificationsByUserId(int $userId): object
    {
        return Notification::where('user_id', $userId)
            ->where('marked_as_read', true)
            ->paginate(10);
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
