<?php

namespace App\Http\Controllers;

use App\Http\Requests\PayRequest;
use App\Repositories\CartRepository;
use App\Traits\OrderServices;
use Illuminate\Http\Request;
use Exception;

class PayController extends AppBaseController
{
    use OrderServices;

    /** @var CartRepository $cartRepository*/
    private $cartRepository;

    public function __construct(CartRepository $cartRepo)
    {
        $this->cartRepository = $cartRepo;
    }

    /**
     * @param $prefix
     * @param PayRequest $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function index($prefix, PayRequest $request)
    {
        $orderId = $request->session()->get('appPayOrderId');
        $amount = $request->session()->get('appPayAmount');

        $amountArray = explode('.', $amount);
        $amount = str_replace(",", "", $amountArray[0]);

        $appUrl = env('APP_URL');

        $payment = [
            'projectid' => env('WEBTOPAY_PROJECTID'),
            'sign_password' => env('WEBTOPAY_SIGN_PASSWORD'),
            'orderid' => $orderId.time(),
            'amount' => $amount,
            'currency' => 'EUR',
            'country' => 'LT',
            'accepturl' => "$appUrl/$prefix/pay/accept/$orderId",
            'cancelurl' => "$appUrl/$prefix/pay/cancel/$orderId",
            'callbackurl' => "$appUrl/$prefix/pay/callback/$orderId"
        ];

        !env('WEBTOPAY_PROD') && $payment['test'] = 1;

        try {
            \WebToPay::redirectToPayment($payment);
        }
        catch (Exception $exception) {
            return back()->with('error', get_class($exception).': '.$exception->getMessage());
        }
        exit;
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function accept(Request $request, $prefix, $id)
    {
        $this->setOrder($request, $id);

        return redirect()
            ->route('vieworder', [$prefix, $id])
            ->with('success', $this->getPaymentMessage($id));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel(Request $request, $prefix, $id)
    {
        $this->setOrder($request, $id);

        return redirect()
            ->route('vieworder', [$prefix, $id])
            ->with('error', __('messages.errorCancelPayment'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return null
     */
    public function callback(Request $request, $id)
    {
        return $this->setOrder($request, $id);
    }

    private function setOrder(Request $request, $id): void
    {
        $params = [];
        parse_str(base64_decode(strtr($request->get('data'), ['-' => '+', '_' => '/'])), $params);

        if (is_array($params) && is_numeric($id)) {
            $order = $this->getOrderById($id);

            if ($order->status_id == 3) {
                $order->advance_payment = true;
                $order->status_id = 4;
                $order->save();
            }
            if ($order->status_id == 7) {
                $order->complete_payment = true;
                $order->save();
            }
        }
    }

    private function getPaymentMessage(int $id): string
    {
        $orderStatusId = $this->getOrderById($id)->status_id;

        if ($orderStatusId == 4) {
            return __('messages.successAdvancePayment');
        }

        return __('messages.successFinalPayment');
    }
}
