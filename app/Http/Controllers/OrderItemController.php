<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderItemRequest;
use App\Http\Requests\UpdateOrderItemRequest;
use App\Models\OrderItem;
use App\Repositories\OrderItemRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class OrderItemController extends AppBaseController
{
    use \App\Http\Controllers\forSelector;

    /** @var OrderItemRepository $orderItemRepository*/
    private $orderItemRepository;

    public function __construct(OrderItemRepository $orderItemRepo)
    {
        $this->orderItemRepository = $orderItemRepo;
    }

    /**
     * Display a listing of the OrderItem.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $orderItems = $this->orderItemRepository->all();

        return view('order_items.index')
            ->with('orderItems', $orderItems);
    }

    /**
     * Show the form for creating a new OrderItem.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $orderItem = new OrderItem([
            'order_id' => $request->get('order_id', 0),
        ]);

        return view('order_items.create')->with([
            'orderItem' => $orderItem,
            'orders_list' => $this->ordersForSelector(),
            'product_list' => $this->productsForSelector(),
        ]);
    }

    /**
     * Store a newly created OrderItem in storage.
     *
     * @param CreateOrderItemRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderItemRequest $request)
    {
        $input = $request->all();

        $orderItem = $this->orderItemRepository->create($input);

        Flash::success('Order Item saved successfully.');

        return redirect(route('orders.show', [$orderItem->order_id]));
    }

    /**
     * Display the specified OrderItem.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orderItem = $this->orderItemRepository->find($id);

        if (empty($orderItem)) {
            Flash::error('Order Item not found');

            return redirect(route('orderItems.index'));
        }

        return view('order_items.show')->with('orderItem', $orderItem);
    }

    /**
     * Show the form for editing the specified OrderItem.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $orderItem = $this->orderItemRepository->find($id);

        if (empty($orderItem)) {
            Flash::error('Order Item not found');

            return redirect(route('orderItems.index'));
        }

        return view('order_items.edit')->with([
            'orderItem' => $orderItem,
            'orders_list' => $this->ordersForSelector(),
            'product_list' => $this->productsForSelector(),
        ]);
    }

    /**
     * Update the specified OrderItem in storage.
     *
     * @param int $id
     * @param UpdateOrderItemRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderItemRequest $request)
    {
        $orderItem = $this->orderItemRepository->find($id);

        if (empty($orderItem)) {
            Flash::error('Order Item not found');

            return redirect(route('orderItems.index'));
        }

        $orderItem = $this->orderItemRepository->update($request->all(), $id);

        Flash::success('Order Item updated successfully.');

        return redirect(route('orders.show', [$orderItem->order_id]));
        //return redirect(route('orderItems.index'));
    }

    /**
     * Remove the specified OrderItem from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $orderItem = $this->orderItemRepository->find($id);

        if (empty($orderItem)) {
            Flash::error('Order Item not found');

            return redirect(route('orderItems.index'));
        }

        $this->orderItemRepository->delete($id);

        Flash::success('Order Item deleted successfully.');

        return redirect(route('orders.show', [$orderItem->order_id]));
        //return redirect(route('orderItems.index'));
    }
}
