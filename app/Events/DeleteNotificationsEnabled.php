<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeleteNotificationsEnabled
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $userId;
    public bool $userDeleteNotifications;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userId, $userDeleteNotifications)
    {
        $this->userId = $userId;
        $this->userDeleteNotifications = $userDeleteNotifications;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
