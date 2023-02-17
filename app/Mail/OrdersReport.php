<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrdersReport extends Mailable
{
    use Queueable, SerializesModels;

    private $name;
    private $orders;
//    private $orderItems;

    public function __construct($name, $orders/*, $orderItems*/)
    {
        $this->name = $name;
        $this->orders = $orders;
//        $this->orderItems = $orderItems;
    }

    private function getAndSetSubject(): string
    {
        $subject = '';

        if (app()->getLocale() == 'lt')
            $subject = 'Užsakymų ataskaita';
        if (app()->getLocale() == 'ru')
            $subject = 'Отчет о заказах';
        if (app()->getLocale() == 'en')
            $subject = 'Orders report';

        return $subject;
    }

    public function build()
    {
        return $this
            ->subject($this->getAndSetSubject())
            ->markdown('orders_report.email', [
                'name' => $this->name,
                'orders' => $this->orders,
//                'orderItems' => $this->orderItems
            ]);
    }
}
