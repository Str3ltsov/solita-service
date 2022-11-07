<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReturnsRequest;
use App\Http\Requests\UpdateReturnsRequest;
use App\Http\Requests\UserCreateReturnsRequest;
use App\Models\LogActivity;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\ReturnItem;
use App\Models\Returns;
use App\Models\ReturnStatus;
use App\Repositories\ReturnItemRepository;
use App\Repositories\ReturnsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class ReturnsController extends AppBaseController
{
    use \App\Http\Controllers\forSelector;
    use \App\Traits\LogTranslator;

    /** @var ReturnsRepository $returnsRepository */
    private $returnsRepository;
    /** @var ReturnItemRepository $returnItemRepository */
    private $returnItemRepository;

    public function __construct(ReturnsRepository $returnsRepo, ReturnItemRepository $returnItemRepo)
    {
        $this->returnsRepository = $returnsRepo;
        $this->returnItemRepository = $returnItemRepo;
    }

    /**
     * Display a listing of the Returns.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $returns = $this->returnsRepository->all();

        return view('returns.index')
            ->with('returns', $returns);
    }

    /**
     * Show the form for creating a new Returns.
     *
     * @return Response
     */
    public function create()
    {
        return view('returns.create')->with([
            'users_list' => $this->usersForSelector(),
            'admin_list' => $this->adminForSelector(),
            'orders_list' => $this->ordersForSelector(),
            'statuses_list' => $this->returnStatusesForSelector(),
        ]);
    }

    /**
     * Store a newly created Returns in storage.
     *
     * @param CreateReturnsRequest $request
     *
     * @return Response
     */
    public function store(CreateReturnsRequest $request)
    {
        $input = $request->all();

        $returns = $this->returnsRepository->create($input);

        Flash::success('Returns saved successfully.');

        return redirect(route('returns.index'));
    }

    /**
     * Display the specified Returns.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $returns = $this->returnsRepository->find($id);

        if (empty($returns)) {
            Flash::error('Returns not found');

            return redirect(route('returns.index'));
        }

        $returnItems = ReturnItem::query()
            ->with('product')
            ->where([
                'return_id' => $returns->id,
            ])
            ->get();

        $logs = $this->getOrderByReturnId($id);

        return view('returns.show')->with([
            'returns' => $returns,
            'returnItems' => $returnItems,
            'logs'=>$logs,
        ]);
    }

    /**
     * Show the form for editing the specified Returns.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $returns = $this->returnsRepository->find($id);

        if (empty($returns)) {
            Flash::error('Returns not found');

            return redirect(route('returns.index'));
        }

        $logs = $this->getOrderByReturnId($id);

        return view('returns.edit')->with([
            'returns' => $returns,
            'users_list' => $this->usersForSelector(),
            'admin_list' => $this->adminForSelector(),
            'orders_list' => $this->ordersForSelector(),
            'statuses_list' => $this->returnStatusesForSelector(),
            'logs' => $logs,
        ]);
    }

    /**
     * Update the specified Returns in storage.
     *
     * @param int $id
     * @param UpdateReturnsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReturnsRequest $request)
    {
        $returns = $this->returnsRepository->find($id);

        if (empty($returns)) {
            Flash::error('Returns not found');

            return redirect(route('returns.index'));
        }

        $returns = $this->returnsRepository->update($request->all(), $id);

        $status = ReturnStatus::where('id', $request->input('status_id'))
            ->value('name');

        $user = Auth::user();

        if ($user) {
            $user->log("Admin set Order ID:{$returns->order_id} Return Status to: {$status}");
        }

        Flash::success('Returns updated successfully.');

        return redirect(route('returns.index'));
    }

    /**
     * Remove the specified Returns from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        $returns = $this->returnsRepository->find($id);

        if (empty($returns)) {
            Flash::error('Returns not found');

            return redirect(route('returns.index'));
        }

        $this->returnsRepository->delete($id);

        Flash::success('Returns deleted successfully.');

        return redirect(route('returns.index'));
    }

    public function indexReturns()
    {
        $userId = Auth::id();
        $returns = $this->returnsRepository->all([
            'user_id' => $userId,
        ]);

        return view('user_views.returns.index')->with([
            'returns' => $returns,
        ]);
    }

    /**
     * View user return
     * @param $id
     * @return Response
     */
    public function viewReturn($id)
    {
        $userId = Auth::id();
        $return = Returns::query()
            ->where([
                'id' => $id,
                'user_id' => $userId,
            ])
            ->first();

        if (empty($return)) {
            Flash::error('Return not found');

            return redirect(route('rootoreturns'));
        }

        $returnItems = ReturnItem::query()
            ->with('product')
            ->where([
                'return_id' => $return->id,
            ])
            ->get();



        $logs = $this->getOrderByReturnId($id);

        foreach ($logs as $log ){
            $log->activity = $this->logTranslate($log->activity, app()->getLocale());

        }

        return view('user_views.returns.view')->with([
            'return' => $return,
            'returnItems' => $returnItems,
            'logs'=>$logs,
        ]);
    }

    public function returnOrder($id)
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

        return view('user_views.orders.return')->with([
            'order' => $order, 'orderItems' => $orderItems,
        ]);
    }


    public function saveReturnOrder($id, UserCreateReturnsRequest $request)
    {
        $userId = Auth::id();
        $input = $request->all();

        if (empty($input['return_items'])) {
            Flash::error('Returns items  selected');

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

            return view('user_views.orders.return')->with([
                'order' => $order, 'orderItems' => $orderItems,
            ]);
        }

        $return_items = $input['return_items'];
        $order = Order::query()
            ->where([
                'id' => $id,
                'user_id' => $userId,
            ])
            ->first();

        if (isset($order)) {
            $returns = $this->returnsRepository->create([
                'user_id' => $userId,
                'admin_id' => 1,
                'order_id' => $order->id,
                'code' => md5(time()),
                'description' => $input['description'],
                'status_id' => 1,
            ]);

            $orderItems = [];
            foreach ($return_items as $item) {

                $orderItems[] = OrderItem::query()
                    ->where([
                        'order_id' => $order->id,
                        'product_id' => $item,
                    ])
                    ->get();
            }


            if (isset($orderItems)) {
                foreach ($orderItems as $item) {

                    $returnItem = $this->returnItemRepository->create([
                        'order_id' => $item[0]->order_id,
                        'user_id' => $userId,
                        'return_id' => $returns->id,
                        'product_id' => $item[0]->product_id,
                        'price_current' => $item[0]->price_current,
                        'count' => $item[0]->count,
                    ]);


                }
            }

            $user = Auth::user();

            if ($user) {
                $user->log("Returned Order ID:{$order->id}");
            }
            $order->status_id = 7;
            $order->save();
        }

        Flash::success('Returns saved successfully.');

        return redirect(route('rootorders'));
    }

    public function cancelOrder($id)
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

        return view('user_views.orders.cancel')->with([
            'order' => $order,
        ]);
    }

    public function saveCancelOrder($id, UserCreateReturnsRequest $request)
    {
        $userId = Auth::id();
        $input = $request->all();

        $order = Order::query()
            ->where([
                'id' => $id,
                'user_id' => $userId,
            ])
            ->first();

        if (isset($order)) {
            $user = Auth::user();

            if ($user) {
                $user->log("Cancelled Order ID:{$order->id}");
            }
            $order->status_id = 5;
            $order->save();
        }

        Flash::success('Order cancelled successfully.');

        return redirect(route('rootorders'));
    }

    /**
     * Helper func to get orderId by passing returnId
     * @param $id return_id
     * @return mixed
     */
    private function getOrderByReturnId($id){
        $orderId = Returns::where(['id' => $id])->value('order_id');

        return LogActivity::search("Order ID:{$orderId}")->get();
    }
}
