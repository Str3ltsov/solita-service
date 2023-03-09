<?php

namespace App\Listeners;

use App\Mail\MessageCreated;
use App\Mail\OrderStatusUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMessageCreatedEmail
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
        $emails = [];

        foreach ($event->users as $messageUser) {
            $emails[] = $messageUser->user->email;
        }

        Mail::to($emails)->send(new MessageCreated($event->sender->name, $event->order->name));
    }
}
