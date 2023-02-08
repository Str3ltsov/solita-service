<?php

namespace App\Listeners;

use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteNotifications
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->userDeleteNotifications) {
            $notifications = Notification::where('user_id', $event->userId)->get();

            foreach ($notifications as $notification) {
                $notificationDate = $notification->created_at->addDays(30)->format('Y-m-d H:i:s');
                $currentDate = now()->format('Y-m-d H:i:s');

                $notificationDate <= $currentDate && $notification->delete();
            }
        }
    }
}
