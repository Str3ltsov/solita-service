<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\PayRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\DiscountCoupon;
use App\Models\LogActivity;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\ReturnItem;
use App\Models\User;
use App\Repositories\CartRepository;
use App\Repositories\DiscountCouponRepository;
use App\Repositories\OrderRepository;
use App\Http\Controllers\AppBaseController;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;
use StyledPDF;

class OrderController extends AppBaseController
{
    use \App\Http\Controllers\forSelector;
    use \App\Traits\LogTranslator;

    /** @var OrderRepository $orderRepository */
    private $orderRepository;

    /** @var CartRepository $cartRepository */
    private $cartRepository;

    /** @var DiscountCouponRepository $discountCouponRepository */
    private $discountCouponRepository;

    public function __construct(OrderRepository $orderRepo, CartRepository $cartRepo, DiscountCouponRepository $discountCouponRepo)
    {
        $this->orderRepository = $orderRepo;
        $this->cartRepository = $cartRepo;
        $this->discountCouponRepository = $discountCouponRepo;
    }

    /**
     * Display a listing of the Order.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $orders = $this->orderRepository->all();

        return view('orders.index')
            ->with('orders', $orders);
    }

    /**
     * Show the form for creating a new Order.
     *
     * @return Response
     */
    public function create()
    {
        return view('orders.create')->with([
            'users_list' => $this->usersForSelector(),
            'admin_list' => $this->adminForSelector(),
            'statuses_list' => $this->orderStatusesForSelector(),
        ]);
    }

    /**
     * Store a newly created Order in storage.
     *
     * @param CreateOrderRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderRequest $request)
    {
        $input = $request->all();

        $order = $this->orderRepository->create($input);

        Flash::success('Order saved successfully.');

        return redirect(route('orders.index'));
    }

    /**
     * Display the specified Order.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        $orderItems = OrderItem::query()
            ->with('product')
            ->where([
                'order_id' => $order->id,
            ])
            ->get();

        $logs = LogActivity::search("Order ID:{$id}")->get();

        return view('orders.show')->with([
            'order' => $order,
            'orderItems' => $orderItems,
            'logs' => $logs,
        ]);
    }

    /**
     * Show the form for editing the specified Order.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        $logs = LogActivity::search("Order ID:{$id}")->get();

        return view('orders.edit')->with([
            'order' => $order,
            'users_list' => $this->usersForSelector(),
            'admin_list' => $this->adminForSelector(),
            'statuses_list' => $this->orderStatusesForSelector(),
            'logs' => $logs,
        ]);
    }

    /**
     * Update the specified Order in storage.
     *
     * @param int $id
     * @param UpdateOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderRequest $request)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        $order = $this->orderRepository->update($request->all(), $id);

        $status = OrderStatus::where('id', $request->input('status_id'))
            ->value('name');

        $user = Auth::user();

        if ($user) {
            $user->log("Admin set Order ID:{$id} Status to: {$status}");
        }

        Flash::success('Order updated successfully.');

        return redirect(route('orders.index'));
    }

    /**
     * Remove the specified Order from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        $this->orderRepository->delete($id);

        Flash::success('Order deleted successfully.');

        return redirect(route('orders.index'));
    }


    /**
     * Orders list
     */
    public function indexOrders()
    {
        $userId = Auth::id();
        $orders = $this->orderRepository->all([
            'user_id' => $userId,
        ]);

        return view('user_views.orders.index')->with([
            'orders' => $orders,
        ]);
    }


    /**
     * View user order
     * @param $id
     * @return Response
     */
    public function viewOrder($id)
    {
        $userId = Auth::id();
        $order = Order::query()
            ->where([
                'id' => $id,
                'user_id' => $userId,
            ])
            ->first();

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('rootorders'));
        }

        $orderItems = OrderItem::query()
            ->with('product')
            ->where([
                'order_id' => $order->id,
            ])
            ->get();

        foreach ($orderItems as $item) {

            $returnItem = ReturnItem::
            where([
                'order_id' => $order->id,
                'user_id' => $userId,
                'product_id' => $item->product_id
            ])
                ->value('product_id');

            if ($item->product_id == $returnItem) {
                $item->setAttribute('isReturned', 'Returned');
            }

        }
        $logs = LogActivity::search("Order ID:{$id}")->get();

        foreach ($logs as $log ){
            $log->activity = $this->logTranslate($log->activity, app()->getLocale());

        }

        return view('user_views.orders.view')->with([
            'order' => $order,
            'orderItems' => $orderItems,
            'logs' => $logs,
        ]);
    }


    public function checkout(Request $request)
    {
        $user = Auth::user();
        $cart = $this->cartRepository->getOrSetCart($request);
        $cartItems = CartItem::query()
            ->with('product')
            ->where([
                'cart_id' => $cart->id,
            ])
            ->get();

        $discounts = DiscountCoupon::query()
            ->where([
                'used' => 0,
                'user_id' => $user->id,
            ])
            ->get();

        return view('user_views.checkout.index')
            ->with([
                'user' => $user,
                'cart' => $cart,
                'cartItems' => $cartItems,
                'discounts' => $discounts,
            ]);
    }


    public function checkoutPreview(PayRequest $request)
    {
        $validated = $request->validated();
        $user = Auth::user();
        $cart = $this->cartRepository->getOrSetCart($request);

        $cartItems = CartItem::query()
            ->with('product')
            ->where([
                'cart_id' => $cart->id,
            ])
            ->get();

        $amount = $this->cartRepository->cartSum($cart, false);

        if (isset($validated['discount']) &&
            is_array($validated['discount'])
        ) {
            $discounts = DiscountCoupon::query()
                ->where([
                    'used' => 0,
                    'user_id' => $user->id,
                ])
                ->whereIn('id', $validated['discount'])
                ->get();

            if ($discounts) {
                foreach ($discounts as $discount) {
                    //$priceDiscounted = $amount * ($discount->value / 100);
                    //$newAmount = $amount - $priceDiscounted;
                    $newAmount = $amount - $discount->value;
                    if ($newAmount > 0) {
                        $amount = $newAmount;

                        $discount->cart_id = $cart->id;
                        $discount->used = 1;
                        $discount->save();
                    }
                }
            }
        }

        $request->session()->put('appPayCartId', $cart->id);
        $request->session()->put('appPayAmount', $amount);

        return view('user_views.checkout.preview')
            ->with([
                'user' => $user,
                'cart' => $cart,
                'cartItems' => $cartItems,
                'discounts' => $discounts ?? [],
                'amount' => $amount,
            ]);
    }

    public function downloadInvoicePdf($id)
    {
        $order = Order::query()
            ->where([
                'id' => $id,
            ])
            ->first();

        $user = Auth::user();
        if ($user->type != 1 && $user->id != $order->user_id) return redirect(route('home'));

        $orderItems = OrderItem::query()
            ->with('product')
            ->where([
                'order_id' => $order->id,
            ])
            ->get();

        $orderItems->map(function ($orderItem) {
            $orderItem->subtotal = $orderItem->price_current * $orderItem->count;

            return $orderItem;
        });

        if ($user->id != $order->user_id) $user = User::query()->where(['id' => $order->user_id])->first();

        return StyledPDF::loadView('user_views.orders.invoice',
            ['order' => $order, 'orderItems' => $orderItems])->stream('invoice.pdf');
    }

    public function invoicePreview($id)
    {
        $order = Order::query()
            ->where([
                'id' => $id,
            ])
            ->first();

        $user = Auth::user();
        if ($user->type != 1 && $user->id != $order->user_id) return redirect(route('home'));

        $orderItems = OrderItem::query()
            ->with('product')
            ->where([
                'order_id' => $order->id,
            ])
            ->get();

        $orderItems->map(function ($orderItem) {
            $orderItem->subtotal = $orderItem->price_current * $orderItem->count;

            return $orderItem;
        });

        if ($user->id != $order->user_id) $user = User::query()->where(['id' => $order->user_id])->first();

        return view('user_views.orders.invoice')->with([
            'order' => $order,
            'orderItems' => $orderItems
        ]);

    }

}
