<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Models\Order;
use App\Models\OrderItem;
use App\Mail\OrdersReport;
use App\Exports\OrdersReportExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Flash;
use DB;
use PDF;
use Excel;


class OrdersReportController extends AppBaseController
{
    private function getOrders() 
    {
        $orders = QueryBuilder::for(Order::class)
            ->allowedFilters([
                AllowedFilter::exact('id'), 
                'user.name',
                'status.name', 
                AllowedFilter::scope('date_from'), 
                AllowedFilter::scope('date_to')
            ])
            ->allowedIncludes(['user', 'status'])
            ->orderBy('id')
            ->get()
            ->map(function($order) {
                $order->total = DB::select("SELECT SUM(price_current) AS total_price_current,
                                             SUM(count) AS total_count, 
                                             SUM(price_current * count) AS total_price
                                             FROM order_items
                                             WHERE order_id = '$order->id'");
    
                return $order;
            });

        return $orders;
    }

    private function getOrderItems() 
    {
        $orderItems = OrderItem::all()
            ->map(function($orderItem) {
                $orderItem->subtotal = $orderItem->price_current * $orderItem->count;

                return $orderItem;
            });

        return $orderItems;
    }

    public function index()
    {
        $orders = $this->getOrders();
        $orderItems = $this->getOrderItems();
        
        return view('orders_report.index')
            ->with(['orders' => $orders, 'orderItems' => $orderItems]);
    }

    public function sendEmail() 
    {
        $orders = $this->getOrders();
        $orderItems = $this->getOrderItems();
        $email = Auth::user()->email;
        
        Mail::to($email)->send(new OrdersReport($orders, $orderItems, $email));

        Flash::success('Email has been sent.');

        return view('orders_report.index')
            ->with(['orders' => $orders, 'orderItems' => $orderItems]);
    }

    public function downloadPdf() 
    {
        $data = [
            'orders' => $this->getOrders(),
            'orderItems' => $this->getOrderItems()
        ];

        $pdf = PDF::loadView('orders_report.report', $data);

        return $pdf->download('orders_report.pdf');
    }

    public function downloadCsv()
    {
        $orders = $this->getOrders();
        $orderItems = $this->getOrderItems();

        return Excel::download(new OrdersReportExport($orders, $orderItems), 'orders_report.csv');
    }
}
