<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CartsReport extends Mailable
{
    use Queueable, SerializesModels;

    private $carts;
    private $cartItems;
    public $email;

    public function __construct($carts, $cartItems, $email)
    {
        $this->carts = $carts;
        $this->cartItems = $cartItems;
        $this->email = $email;
    }

    public function build()
    {
        return $this
            ->subject('Carts Report')
            ->markdown('carts_report.email', [
                'carts' => $this->carts,
                'cartItems' => $this->cartItems
            ]);
    }
}
