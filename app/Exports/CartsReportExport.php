<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Cart;
use App\Models\CartItem;

class CartsReportExport implements FromView
{
    private $carts;
    private $cartItems;

    public function __construct($carts, $cartItems)
    {
        $this->carts = $carts;
        $this->cartItems = $cartItems;
    }

    public function view(): View
    {
        return view('carts_report.report', [
            'carts' => $this->carts,
            'cartItems' => $this->cartItems
        ]);
    }
}
