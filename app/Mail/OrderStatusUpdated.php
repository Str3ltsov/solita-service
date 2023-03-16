<?php

namespace App\Mail;

use App\Models\OrderStatus;
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
    public int $prevOrderStatusId;
    public int $newOrderStatusId;

    public array $translatedStatusNames;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $name, $orderId, $prevOrderStatusId, $newOrderStatusId)
    {
        $this->email = $email;
        $this->name = $name;
        $this->orderId = $orderId;
        $this->prevOrderStatusId = $prevOrderStatusId;
        $this->newOrderStatusId = $newOrderStatusId;

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
                'prevOrderStatus' => $this->translatedStatusNames[$this->prevOrderStatusId],
                'newOrderStatus' => $this->translatedStatusNames[$this->newOrderStatusId],
            ]);
    }
}
