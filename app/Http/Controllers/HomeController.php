<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Message;
use App\Models\Order;
use App\Models\Returns;
use App\Repositories\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /** @var CartRepository $cartRepository */
    private $cartRepository;

    public function __construct(CartRepository $cartRepo)
    {
        //$this->middleware(['auth', 'cookie-consent']);
        $this->cartRepository = $cartRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = Auth::user();


        return view('home',
            [
                'lang' => app()->getLocale(),
                'cartItems' => $this->getCartItems($request),
                'orders' => $this->getOrders($user->id),
                'returns' => $this->getReturns($user->id),
                'messages' => $this->getMessages($user->id)
            ]);
    }

    public function home(Request $request)
    {
        return view('user_views.home', ['lang' => app()->getLocale()]);
    }

    private function getCartItems($request)
    {
        $cart = $this->cartRepository->getOrSetCart($request);

        $cartItems = CartItem::query()
            ->with('product')
            ->where([
                'cart_id' => $cart->id,
            ])
            ->get();
        if ($cartItems->isEmpty()) $cartItems = [];

        return $cartItems;
    }

    private function getOrders($userId)
    {
        $orders = Order::where("user_id", $userId)->latest()->take(3)->get();

        if ($orders->isEmpty()) $orders = [];

        return $orders;
    }

    private function getReturns($userId)
    {
        $returns = Returns::where("user_id", $userId)->latest()->take(3)->get();

        if ($returns->isEmpty()) $returns = [];

        return $returns;
    }

    private function getMessages($userId)
    {
        return Message::where("unread", 1)->where("user_to", $userId)->count();

    }
}
