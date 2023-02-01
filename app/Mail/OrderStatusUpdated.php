<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public string $email;
    public string $name;
    public int $orderId;
    public string $prevOrderStatus;
    public string $newOrderStatus;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $name, $orderId, $prevOrderStatus, $newOrderStatus)
    {
        $this->email = $email;
        $this->name = $name;
        $this->orderId = $orderId;
        $this->prevOrderStatus = $prevOrderStatus;
        $this->newOrderStatus = $newOrderStatus;
    }

    private function getAndSetSubject(): string
    {
        $subject = '';

        if (app()->getLocale() == 'lt')
            $subject = 'Užsakymo būsenos keitimas';
        if (app()->getLocale() == 'ru')
            $subject = 'Изменение статуса заказа';
        if (app()->getLocale() == 'en')
            $subject = 'Order status change';

        return $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject($this->getAndSetSubject())
            ->markdown('order_status_updated', [
                'email' => $this->email,
                'name' => $this->name,
                'orderId' => $this->orderId,
                'prevOrderStatus' => $this->prevOrderStatus,
                'newOrderStatus' => $this->newOrderStatus
            ]);
    }
}
