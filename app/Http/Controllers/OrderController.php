<?php

namespace App\Http\Controllers;

use App\Events\OrderStatusUpdated;
use App\Http\Requests\CreateOrderFileRequest;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\PayRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Controllers\forSelector;
use App\Models\OrderFile;
use App\Models\OrderPriority;
use App\Models\OrderUser;
use App\Models\OrderUserActivities;
use App\Models\Product;
use App\Traits\LogTranslator;
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
use App\Traits\OrderFileServices;
use App\Traits\OrderServices;
use App\Traits\UserReviewServices;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Flash;
use Response;
use StyledPDF;

class OrderController extends AppBaseController
{
    use forSelector, LogTranslator, OrderServices, UserReviewServices, OrderFileServices;

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
        return view('orders.create')
            ->with([
                'users_list' => $this->usersForSelector(),
                'employee_list' => $this->orderEmployeeForSelector(),
                'statuses_list' => $this->orderStatusesForSelector(),
                'priority_list' => $this->orderPrioritiesForSelector(),
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

        $this->orderRepository->create($input);

        Flash::success('Order saved successfully.');

        return redirect(route('orders.index'));
    }

    /**
     * Display the specified Order.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $order = $this->getOrderById($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        return view('orders.show')
            ->with([
                'order' => $order,
                'orderFileExtensions' => $this->getOrderFileExtensions($order->files),
                'logs' => LogActivity::search("Order ID:{$id}")->get(),
                'specialistCount' => count($this->getNotAddedSpecialists($order->specialists)),
                'specActivities' => $this->getOrderUserActivitiesForMany($id, $order->specialists),
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
        $order = $this->getOrderById($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        $logs = LogActivity::search("Order ID:{$id}")->get();

        return view('orders.edit')->with([
            'order' => $order,
            'users_list' => $this->usersForSelector(),
            'employee_list' => $this->orderEmployeeForSelector(),
            'statuses_list' => $this->orderStatusesForSelector(),
            'priority_list' => $this->orderPrioritiesForSelector(),
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

        foreach ($order->specialists as $specialist) {
            $specialist->delete();
        }

        OrderUserActivities::where('order_id', $order->id)->delete();

        OrderFile::where('order_id', $order->id)->delete();

        $this->orderRepository->delete($id);

        Flash::success('Order deleted successfully.');

        return redirect(route('orders.index'));
    }

    /*
     * Add order specialists page.
     */
    public function adminAddOrderSpecialist(int $id): Factory|View|Application
    {
        $order = $this->getOrderById($id);
        $orderSpecialists = $this->getNotAddedSpecialists($order->specialists);

        return view('orders.add_specialist')
            ->with([
                'order' => $order,
                'specialists' => $orderSpecialists,
                'specialistAverageRating' =>  $this->getReviewAverageRatingSpecialists($orderSpecialists)
            ]);
    }

    /*
     * Form that adds order specialists.
     */
    public function adminAddOrderSpecialistSave(int $id, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'specialistsIds' => 'required',
            'specialistsHours' => 'required'
        ]);

        try {
            $specIds = explode(',', $validated['specialistsIds']);
            $specHours = explode(',', $validated['specialistsHours']);

            $this->createOrderSpecialists($specIds, $specHours, $id);
            $this->updateSpecialistOccupation($specIds);

            return redirect()
                ->route('orders.show', $id)
                ->with('success', __('messages.successAddOrderSpec'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }

    /*
     * Form that updates order specialist hours.
     */
    public function adminUpdateOrderSpecialists(int $id, Request $request): RedirectResponse
    {
        $validated = $request->validate(['specHours' => 'required']);

        try {
            $specHours = explode(',', $validated['specHours']);

            $orderUsers = OrderUser::where('order_id', $id)->get();

            foreach ($orderUsers as $key => $orderUser) {
                $orderUser->hours = $specHours[$key];
                $orderUser->complete_percentage = round($orderUser->complete_hours * 100 / $orderUser->hours, 2);
                $orderUser->updated_at = now();
                $orderUser->save();
            }

            $this->updateSpecialistOccupation($orderUsers->pluck('user_id')->toArray());

            return back()->with('success', __('messages.successUpdateOrderSpec'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }

    /*
     * Form that deletes order specialists.
     */
    public function adminDeleteOrderSpecialist(int $id): RedirectResponse
    {
        try {
            $orderUser = OrderUser::find($id);
            $orderUser->delete();

            $specIds = [];
            $specIds[] = $orderUser->user_id;

            $this->updateSpecialistOccupation($specIds);
            $this->subtractSpecialistCompleteHours($orderUser);

            return back()->with('success', __('messages.successDeleteOrderSpec'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
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
     * @return Application|Factory|View
     */
    public function viewOrder($prefix, $id)
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

            return redirect(route('rootorders', $prefix));
        }

//        $orderItems = OrderItem::query()
//            ->with('product')
//            ->where([
//                'order_id' => $order->id,
//            ])
//            ->get();

//        foreach ($orderItems as $item) {
//
//            $returnItem = ReturnItem::
//            where([
//                'order_id' => $order->id,
//                'user_id' => $userId,
//                'product_id' => $item->product_id
//            ])
//                ->value('product_id');
//
//            if ($item->product_id == $returnItem) {
//                $item->setAttribute('isReturned', 'Returned');
//            }
//
//        }
//
//        $this->setOrderItemCountSum($orderItems);

        $logs = LogActivity::search("Order ID:{$id}")->get();

        foreach ($logs as $log) {
            $log->activity = $this->logTranslate($log->activity, app()->getLocale());
        }

        return view('user_views.orders.view')->with([
            'order' => $order,
//            'orderItems' => $orderItems,
//            'orderItemCountSum' => $this->getOrderItemCountSum(),
            'logs' => $logs,
            'orderFileExtensions' => $this->getOrderFileExtensions($order->files)
        ]);
    }

//    public function checkout(Request $request)
//    {
//        $user = Auth::user();
//        $cart = $this->cartRepository->getOrSetCart($request);
//        $cartItems = CartItem::query()
//            ->with('product')
//            ->where([
//                'cart_id' => $cart->id,
//            ])
//            ->get();
//
//        $discounts = DiscountCoupon::query()
//            ->where([
//                'used' => 0,
//                'user_id' => $user->id,
//            ])
//            ->get();
//
//        return view('user_views.checkout.index')
//            ->with([
//                'user' => $user,
//                'cart' => $cart,
//                'cartItems' => $cartItems,
//                'discounts' => $discounts,
//            ]);
//    }
//
//
//    public function checkoutPreview(PayRequest $request)
//    {
//        $validated = $request->validated();
//        $user = Auth::user();
//        $cart = $this->cartRepository->getOrSetCart($request);
//
//        $cartItems = CartItem::query()
//            ->with('product')
//            ->where([
//                'cart_id' => $cart->id,
//            ])
//            ->get();
//
//        $amount = $this->cartRepository->cartSum($cart, false);
//
//        if (isset($validated['discount']) &&
//            is_array($validated['discount'])
//        ) {
//            $discounts = DiscountCoupon::query()
//                ->where([
//                    'used' => 0,
//                    'user_id' => $user->id,
//                ])
//                ->whereIn('id', $validated['discount'])
//                ->get();
//
//            if ($discounts) {
//                foreach ($discounts as $discount) {
//                    //$priceDiscounted = $amount * ($discount->value / 100);
//                    //$newAmount = $amount - $priceDiscounted;
//                    $newAmount = $amount - $discount->value;
//                    if ($newAmount > 0) {
//                        $amount = $newAmount;
//
//                        $discount->cart_id = $cart->id;
//                        $discount->used = 1;
//                        $discount->save();
//                    }
//                }
//            }
//        }
//
//        $request->session()->put('appPayCartId', $cart->id);
//        $request->session()->put('appPayAmount', $amount);
//
//        return view('user_views.checkout.preview')
//            ->with([
//                'user' => $user,
//                'cart' => $cart,
//                'cartItems' => $cartItems,
//                'discounts' => $discounts ?? [],
//                'amount' => $amount,
//            ]);
//    }

    private function getProductById(int $id): object
    {
        $product = Product::find($id);

        if (empty($product))
            throw new \Error(__('messages.errorEmptyProduct'));

        return $product;
    }

    private function getEmployeeId(): int
    {
        $employee = User::select('id')->where('type', 3)->pluck('id')->first();

        if (empty($employee))
            throw new \Error(__('messages.errorEmptyEmployee'));

        return $employee;
    }

    private function getSpecialists(): LengthAwarePaginator
    {
        return User::select('id', 'name', 'hourly_price', 'average_rating', 'experience_id')
            ->where('type', 2)
            ->paginate(5);
    }

    private function getForEachUserAverageRating(object $specialists)
    {
        foreach ($specialists as $specialist) {
            $specialist->averageRating = round($specialist->average_rating, 1);
        }
    }

    public function getCreateOpenOrder($prefix): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $specialists = $this->getSpecialists();
        $this->getForEachUserAverageRating($specialists);

        return view('user_views.create_order.index')
            ->with([
                'employeeId' => $this->getEmployeeId(),
                'specialists' => $specialists
            ]);
    }

    /*
     * Gets create order view with product id.
     */
    public function getCreateOrder($prefix, $id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $specialists = $this->getSpecialists();
        $this->getForEachUserAverageRating($specialists);

        return view('user_views.create_order.index')
            ->with([
                'product' => $this->getProductById($id),
                'employeeId' => $this->getEmployeeId(),
                'specialists' => $specialists
            ]);
    }

    private function createOrderValidationRules(object $request): array
    {
        return $request->validate([
            ...Order::$rules,
            'specialistsIds' => 'nullable|string',
            'specialistsHours' => 'nullable|string'
        ]);
    }

    private function checkOrderAndSpecialistHours(string $totalHours, array $specHours): void
    {
        if (empty($specHours[0])) return;

        $specHoursSum = 0;

        foreach ($specHours as $specHour) {
            $specHoursSum += (int)$specHour;
        }

        if ((int)$totalHours < $specHoursSum)
            throw new \Error(__('messages.errorMoreHours'));
        if ((int)$totalHours > $specHoursSum)
            throw new \Error(__('messages.errorLessHours'));
    }

    private function createNewOrder(array $validated): object
    {
        return Order::firstOrCreate([
            'order_id' => $validated['order_id'],
            'user_id' => $validated['user_id'],
            'employee_id' => $validated['employee_id'],
            'status_id' => $validated['status_id'],
            'priority_id' => $validated['priority_id'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'budget' => $validated['budget'],
            'total_hours' => $validated['total_hours'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'created_at' => now()
        ]);
    }

    private function updateOrderStatus(array $validated, object $newOrder): void
    {
        foreach ($validated as $param) {
            if (is_null($param)) return;
        }

        $newOrder->status_id = 2;
        $newOrder->save();
    }

    private function calculateOrderSum(array $specIds, array $specHours, float $newOrderBudget)
    {
        if (empty($specIds[0])) return;

        $specHourlyPriceSum = 0;

        foreach ($specIds as $key => $specId) {
            $specHourlyPrice = User::select('id', 'hourly_price')
                ->where('id', $specId)
                ->pluck('hourly_price')
                ->first();

            $specHourlyPriceSum += $specHourlyPrice * $specHours[$key];
        }

        return $newOrderBudget + $specHourlyPriceSum;
    }

    private function updateOrderSum(object $newOrder, ?float $newOrderSum): void
    {
        $newOrder->sum = $newOrderSum ?? $newOrder->budget;
        $newOrder->save();
    }

    private function createNewOrderUsers(array $specIds, array $specHours, int $newOrderId): void
    {
        if (empty($specIds[0])) return;

        foreach ($specIds as $key => $specId) {
            OrderUser::firstOrCreate([
                'order_id' => $newOrderId,
                'user_id' => $specId,
                'hours' => $specHours[$key] ?? null
            ]);
        }
    }

    /*
     * Creates order and order users if present.
     */
    public function postCreateOrder($prefix, Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $validated = $this->createOrderValidationRules($request);

        try {
            $specialistsIds = explode(',', $validated['specialistsIds']);
            $specialistsHours = explode(',', $validated['specialistsHours']);

            $this->checkOrderAndSpecialistHours($validated['total_hours'], $specialistsHours);

            $newOrder = $this->createNewOrder($validated);

            $this->updateOrderStatus($validated, $newOrder);

            $newOrderSum = $this->calculateOrderSum($specialistsIds, $specialistsHours, $newOrder->budget);
            $this->updateOrderSum($newOrder, $newOrderSum);

            $this->createNewOrderUsers($specialistsIds, $specialistsHours, $newOrder->id);

//            user_views.orders.view
            return redirect()
                ->route('vieworder', [$prefix, $newOrder->id])
                ->with('success', __('messages.successCreateOrder').$newOrder->id);
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }

    /*
     * Changes order status to approved by client.
     */
    public function approveOrder($prefix, $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $order = $this->getOrderById($id);
            $newOrderStatus = Order::APPROVED_CLIENT;

            event(new OrderStatusUpdated($order, $newOrderStatus));

            $order->status_id = $newOrderStatus;
            $order->save();

            $user = auth()->user();
            $user->log("{$user->role->name}:{$user->name} set Order ID:{$id} Status to:{$order->status->name}");

            return back()->with('success', __('messages.successApprovedOrder'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }

    /*
     * Uploads order document files to public folder and creates database record.
     */
    public function uploadDocument($prefix, CreateOrderFileRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $id = $validated['order_id'];
            $path = public_path().'/documents/orders/'.$id;

            $this->createDirForOrderFiles($path);

            $file = $validated['document'];
            $fileName = $file->getClientOriginalName();
            $file->move($path, $fileName);

            $this->createOrderFile($id, $fileName);

            return back()->with('success', __('messages.successOrderUploadFile'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }

    /*
     * Responses with a download option for selected document.
     */
    public function downloadDocument($prefix, $orderId, $docId): BinaryFileResponse|RedirectResponse
    {
        $document = OrderFile::find($docId);
        $path = public_path("documents/$orderId/$document->name");

        if (File::exists($path))
            return response()->download($path);
        else
            $path = public_path("documents/offers/$document->name");

            if (!File::exists($path))
                return back()->with('error', __('messages.errorFileNotExist'));

            return response()->download($path);
    }

//    public function downloadInvoicePdf($id)
//    {
//        $order = Order::query()
//            ->where([
//                'id' => $id,
//            ])
//            ->first();
//
//        $user = Auth::user();
//        if ($user->type != 1 && $user->id != $order->user_id) return redirect(route('home'));
//
//        $orderItems = OrderItem::query()
//            ->with('product')
//            ->where([
//                'order_id' => $order->id,
//            ])
//            ->get();
//
//        $orderItems->map(function ($orderItem) {
//            $orderItem->subtotal = $orderItem->price_current * $orderItem->count;
//
//            return $orderItem;
//        });
//
//        if ($user->id != $order->user_id) $user = User::query()->where(['id' => $order->user_id])->first();
//
//        return StyledPDF::loadView('user_views.orders.invoice',
//            ['order' => $order, 'orderItems' => $orderItems])->stream('invoice.pdf');
//    }
//
//    public function invoicePreview($id)
//    {
//        $order = Order::query()
//            ->where([
//                'id' => $id,
//            ])
//            ->first();
//
//        $user = Auth::user();
//        if ($user->type != 1 && $user->id != $order->user_id) return redirect(route('home'));
//
//        $orderItems = OrderItem::query()
//            ->with('product')
//            ->where([
//                'order_id' => $order->id,
//            ])
//            ->get();
//
//        $orderItems->map(function ($orderItem) {
//            $orderItem->subtotal = $orderItem->price_current * $orderItem->count;
//
//            return $orderItem;
//        });
//
//        if ($user->id != $order->user_id) $user = User::query()->where(['id' => $order->user_id])->first();
//
//        return view('user_views.orders.invoice')->with([
//            'order' => $order,
//            'orderItems' => $orderItems
//        ]);
//
//    }

}
