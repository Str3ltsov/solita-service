<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageCreated extends Mailable
{
    use Queueable, SerializesModels;

    private string $senderName;
    private string $orderName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($senderName, $orderName)
    {
        $this->senderName = $senderName;
        $this->orderName = $orderName;
    }

    private function getAndSetSubject(): string
    {
        $subject = '';

        if (app()->getLocale() == 'lt')
            $subject = 'Naujas pranešimas';
        if (app()->getLocale() == 'ru')
            $subject = 'Новое сообщение';
        if (app()->getLocale() == 'en')
            $subject = 'New message';

        return $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->getAndSetSubject())
            ->markdown('message_created', [
                'senderName' => $this->senderName,
                'orderName' => $this->orderName
            ]);
    }
}
