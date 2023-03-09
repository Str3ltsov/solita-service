<?php

namespace App\Listeners;

use App\Models\Message;
use App\Models\Notification;
use App\Traits\MessageServices;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteMessages
{
    use MessageServices;

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
        if ($event->userDeleteMessages) {
            $messages = Message::where('sender_id', $event->userId)->get();

            foreach ($messages as $message) {
                $messageDate = $message->created_at->addDays(30)->format('Y-m-d H:i:s');
                $currentDate = now()->format('Y-m-d H:i:s');

                if ($messageDate <= $currentDate) {
                    foreach ($message->messageUsers as $user) {
                        $user->delete();
                    }

                    $replyMessages = $this->getReplyMessagesByMainMessageId($message->id);

                    foreach ($replyMessages as $replyMessage) {
                        $replyMessage->delete();
                    }

                    $message->delete();
                }
            }
        }
    }
}
