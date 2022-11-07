<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Order;
use App\Models\OrderItem;

class OrdersReportExport implements FromView
{
    private $orders;
    private $orderItems;

    public function __construct($orders, $orderItems)
    {
        $this->orders = $orders;
        $this->orderItems = $orderItems;
    }

    public function view(): View
    {
        return view('orders_report.report', [
            'orders' => $this->orders,
            'orderItems' => $this->orderItems
        ]);
    }
}
