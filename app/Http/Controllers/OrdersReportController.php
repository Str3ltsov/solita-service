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
use Barryvdh\DomPDF\Facade\Pdf;
use Flash;
use DB;
use Excel;


class OrdersReportController extends AppBaseController
{
    use forSelector;

    private function getOrders()
    {
        return QueryBuilder::for(Order::class)
            ->allowedFilters([
                AllowedFilter::exact('id'),
                'user.name',
                'employee.name',
                'status.id',
                AllowedFilter::exact('name'),
                AllowedFilter::exact('budget'),
                AllowedFilter::exact('total_hours'),
                AllowedFilter::exact('complete_hours'),
                AllowedFilter::exact('start_date'),
                AllowedFilter::exact('end_date'),
                AllowedFilter::scope('date_from'),
                AllowedFilter::scope('date_to')
            ])
            ->allowedIncludes(['user', 'status'])
            ->orderBy('id')
            ->paginate(50);
    }

//    private function getOrderItems()
//    {
//        $orderItems = OrderItem::all()
//            ->map(function($orderItem) {
//                $orderItem->subtotal = $orderItem->price_current * $orderItem->count;
//
//                return $orderItem;
//            });
//
//        return $orderItems;
//    }

    public function index(Request $request)
    {
//        $orderItems = $this->getOrderItems();

        return view('orders_report.index')
            ->with([
                'orders' => $this->getOrders(),
//                'orderItems' => $orderItems
                'statuses' => $this->orderStatusesForSelector(),
                'filter' => $request->query('filter') ?? ''
            ]);
    }

    public function sendEmail()
    {
        $orders = $this->getOrders();
//        $orderItems = $this->getOrderItems();

        Mail::to(Auth::user()->email)->send(new OrdersReport($orders/*, $orderItems*/));

        return back()->with('success', __('messages.successOrdersReportEmail'));
    }

    public function downloadPdf()
    {
        $data = [
            'orders' => $this->getOrders(),
//            'orderItems' => $this->getOrderItems()
        ];

        $pdf = PDF::loadView('orders_report.report', $data)
            ->setPaper('a3', 'landscape');

        return $pdf->download('orders_report.pdf');
    }

    public function downloadCsv()
    {
        $orders = $this->getOrders();
//        $orderItems = $this->getOrderItems();

        return Excel::download(new OrdersReportExport($orders/*, $orderItems*/), 'orders_report.csv');
    }
}
