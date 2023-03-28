<?php

namespace App\Http\Controllers;

use App\Http\Requests\PayRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\DiscountCoupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPriority;
use App\Models\SpecialistOccupation;
use App\Models\User;
use App\Repositories\CartRepository;
use Exception;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class PayController extends AppBaseController
{
    /** @var CartRepository $cartRepository*/
    private $cartRepository;

    public function __construct(CartRepository $cartRepo)
    {
        $this->cartRepository = $cartRepo;
    }

    public function index(PayRequest $request)
    {
        $cartId = $request->session()->get('appPayCartId');
        $amount = $request->session()->get('appPayAmount');
//        $amount = str_replace(".", "", $amount);
//        $amount = $amount * 10;

//        if (!preg_match("/\./", $amount)) {
            if(strpos($amount, ".") == strlen($amount)-2)  $amount = $amount . "0";
            elseif (strpos($amount, ".") === false ) $amount = $amount . "00";
//            elseif(strpos($amount, ".") == strlen($amount)-3)  $amount = $amount . "00";
//        }

//        $amount = str_replace(".", "", $amount);
        $amount = preg_replace("/\D/", "", $amount);


        $appUrl = env('APP_URL');
        $payment = [
            'projectid' => env('WEBTOPAY_PROJECTID'),
            'sign_password' => env('WEBTOPAY_SIGN_PASSWORD'),
            'orderid' => time(),
            'amount' => $amount,
            'currency' => 'EUR',
            'country' => 'LT',
            'accepturl' => $appUrl. '/user/pay/accept/' . $cartId,
            'cancelurl' => $appUrl. '/user/pay/cancel/' . $cartId,
            'callbackurl' => $appUrl. '/user/pay/callback/' . $cartId,
        ];

        if (true !== env('WEBTOPAY_PROD')) {
            $payment['test'] = 1;
        }

        try {
            \WebToPay::redirectToPayment($payment);
        } catch (Exception $exception) {
            echo get_class($exception) . ':' . $exception->getMessage();
        }
        exit;
    }

    public function accept(Request $request, $id)
    {
        $this->setOrder($request, $id);
        return view('user_views.pay.accept');
    }

    public function cancel(Request $request, $id)
    {
        $this->setOrder($request, $id);
        return view('user_views.pay.cancel');
    }

    public function callback(Request $request, $id)
    {
        return $this->setOrder($request, $id);
    }

    private function setOrder(Request $request, $id)
    {
        $params = [];
        parse_str(base64_decode(strtr($request->get('data'), ['-' => '+', '_' => '/'])), $params);

        if (is_array($params) &&
            isset($params['status']) &&
            $params['status'] == 1 &&
            is_numeric($id)
        ) {
            $cart = $this->cartRepository->find($id);

            if ($cart) {
                $cartItems = CartItem::query()
                    ->where([
                        'cart_id' => $cart->id,
                    ])
                    ->get();

                $cart->status_id = Cart::STATUS_OFF;
                $cart->save();

                DiscountCoupon::where([
                    'cart_id' => $cart->id,
                ])->update([
                    'used' => 1
                ]);

                $newOrder = new Order();
                $newOrder->cart_id = $cart->id;
                $newOrder->order_id = $params['orderid'];
                $newOrder->user_id = $cart->user_id;
                $newOrder->specialist_id = rand(4, 5);
                $newOrder->employee_id = 6;
                $newOrder->status_id = 2;
                $newOrder->total_hours = rand(50, 200);
                $newOrder->complete_hours = rand(1, 25);
                $newOrder->sum = $params['amount'] / 100;
                $newOrder->priority_id = OrderPriority::LOW;

                if ($newOrder->save()) {

                    foreach ($cartItems as $cartItem) {
                        $newOrderItem = new OrderItem();
                        $newOrderItem->order_id = $newOrder->id;
                        $newOrderItem->product_id = $cartItem->product_id;
                        $newOrderItem->price_current = $cartItem->price_current;
                        $newOrderItem->count = $cartItem->count;
                        $newOrderItem->save();
                    }
                    $user = Auth::user();

                    if($user){
//                        $user->log("Created new Order ID:{$params['orderid']}");
                        $user->log("Created new Order ID:{$newOrder->id}");
                    }

                    //Updating specialist occupation percentage
                    $specialistId = $newOrder->specialist_id;
                    $orders = $this->getOrdersBySpecialistId($specialistId);
                    $occupation = $this->getSpecialistOccupation($specialistId);

                    $this->updateSpecialistOccupation($orders, $occupation);

                    return 'OK';
                }
            }
        }

        return 'Error';
    }

    private function getOrdersBySpecialistId(int $specialistId): object
    {
        return Order::select('id', 'total_hours', 'complete_hours', 'specialist_id')
            ->where('specialist_id', $specialistId)
            ->get();
    }

    private function getSpecialistOccupation(int $specialistId): object
    {
        return SpecialistOccupation::where('specialist_id', $specialistId)->get();
    }

    private function updateSpecialistOccupation(object $orders, object $occupation): void
    {
        $totalHoursSum = 0;
        $completeHoursSum = 0;

        foreach ($orders as $order) {
            $totalHoursSum += $order->total_hours;
            $completeHoursSum += $order->complete_hours;
        }

        $uncompletedHours = $totalHoursSum - $completeHoursSum;
        $occupationPercentage = round(($uncompletedHours / $totalHoursSum * 100), 2);

        $occupation->percentage = $occupationPercentage;
        $occupation->save();
    }

    /*private function getAdminId()
    {
        $admins = User::query()
            ->select('id')
            ->withCount('adminOrders')
            ->where([
                'type' => 1
            ])
            ->get()
            ->toArray();

        $admins = array_column($admins, 'id', 'admin_orders_count');
        ksort($admins);

        return array_shift($admins);
    }*/
}
