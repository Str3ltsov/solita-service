<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Models\Cart;
use App\Models\CartItem;
use App\Mail\CartsReport;
use App\Repositories\CartItemRepository;
use App\Exports\CartsReportExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Flash;
use DB;
use PDF;
use Excel;

class CartsReportController extends AppBaseController
{
    private $cartItemRepository;

    public function __construct(CartItemRepository $cartItemRepo)
    {
        $this->cartItemRepository = $cartItemRepo;
    }

    private function getCarts() 
    {
        $orders = QueryBuilder::for(Cart::class)
            ->allowedFilters([
                AllowedFilter::exact('id'), 
                'user.name',
                'code',
                'status.name', 
                AllowedFilter::scope('date_from'), 
                AllowedFilter::scope('date_to')
            ])
            ->allowedIncludes(['user', 'status'])
            ->orderBy('id')
            ->get()
            ->map(function($cart) {
                $cart->total = DB::select("SELECT SUM(price_current) AS total_price_current,
                                             SUM(count) AS total_count, 
                                             SUM(price_current * count) AS total_price
                                             FROM cart_items
                                             WHERE cart_id = '$cart->id'");
    
                return $cart;
            });

        return $orders;
    }

    private function getCartItems() 
    {
        $cartItems = $this->cartItemRepository
            ->all()
            ->map(function($cartItem) {
                $cartItem->subtotal = $cartItem->price_current * $cartItem->count;

                return $cartItem;
            });

        return $cartItems;
    }

    public function index()
    {
        $carts = $this->getCarts();
        $cartItems = $this->getCartItems();
        
        return view('carts_report.index')
            ->with(['carts' => $carts, 'cartItems' => $cartItems]);
    }

    public function sendEmail() 
    {
        $carts = $this->getCarts();
        $cartItems = $this->getCartItems();
        $email = Auth::user()->email;
        
        Mail::to($email)->send(new CartsReport($carts, $cartItems, $email));

        Flash::success('Email has been sent.');

        return view('carts_report.index')
            ->with(['carts' => $carts, 'cartItems' => $cartItems]);
    }

    public function downloadPdf() 
    {
        $data = [
            'carts' => $this->getCarts(),
            'cartItems' => $this->getCartItems()
        ];

        $pdf = PDF::loadView('carts_report.report', $data);

        return $pdf->download('carts_report.pdf');
    }

    public function downloadCsv()
    {
        $carts = $this->getCarts();
        $cartItems = $this->getCarts();

        return Excel::download(new CartsReportExport($carts, $cartItems), 'carts_report.csv');
    }
}
