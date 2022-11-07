<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrdersReport extends Mailable
{
    use Queueable, SerializesModels;

    private $orders;
    private $orderItems;
    public $email;

    public function __construct($orders, $orderItems, $email)
    {
        $this->orders = $orders;
        $this->orderItems = $orderItems;
        $this->email = $email;
    }

    public function build()
    {
        return $this
            ->subject('Orders Report')
            ->markdown('orders_report.email', [
                'orders' => $this->orders,
                'orderItems' => $this->orderItems
            ]);
    }
}
