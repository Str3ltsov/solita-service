<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReturnItemRequest;
use App\Http\Requests\UpdateReturnItemRequest;
use App\Repositories\ReturnItemRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ReturnItemController extends AppBaseController
{
    use \App\Http\Controllers\forSelector;

    /** @var ReturnItemRepository $returnItemRepository */
    private $returnItemRepository;

    public function __construct(ReturnItemRepository $returnItemRepo)
    {
        $this->returnItemRepository = $returnItemRepo;
    }

    /**
     * Display a listing of the ReturnItem.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $returnItems = $this->returnItemRepository->all();

        return view('return_items.index')
            ->with('returnItems', $returnItems);
    }

    /**
     * Show the form for creating a new ReturnItem.
     *
     * @return Response
     */
    public function create()
    {
        return view('return_items.create')
            ->with(['orders_list' => $this->ordersForSelector(),
            'users_list' => $this->usersForSelector(),
            'returns_list' => $this->returnsForSelector(),
            'product_list' => $this->productsForSelector(),]);
    }

    /**
     * Store a newly created ReturnItem in storage.
     *
     * @param CreateReturnItemRequest $request
     *
     * @return Response
     */
    public function store(CreateReturnItemRequest $request)
    {
        $input = $request->all();

        $returnItem = $this->returnItemRepository->create($input);

        Flash::success('Return Item saved successfully.');

        return redirect(route('returnItems.index'));
    }

    /**
     * Display the specified ReturnItem.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $returnItem = $this->returnItemRepository->find($id);

        if (empty($returnItem)) {
            Flash::error('Return Item not found');

            return redirect(route('returnItems.index'));
        }

        return view('return_items.show')->with('returnItem', $returnItem);
    }

    /**
     * Show the form for editing the specified ReturnItem.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $returnItem = $this->returnItemRepository->find($id);

        if (empty($returnItem)) {
            Flash::error('Return Item not found');

            return redirect(route('returnItems.index'));
        }

        return view('return_items.edit')->with([
            'returnItem' => $returnItem,
            'orders_list' => $this->ordersForSelector(),
            'users_list' => $this->usersForSelector(),
            'returns_list' => $this->returnsForSelector(),
            'product_list' => $this->productsForSelector(),
        ]);
    }

    /**
     * Update the specified ReturnItem in storage.
     *
     * @param int $id
     * @param UpdateReturnItemRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReturnItemRequest $request)
    {
        $returnItem = $this->returnItemRepository->find($id);

        if (empty($returnItem)) {
            Flash::error('Return Item not found');

            return redirect(route('returnItems.index'));
        }

        $returnItem = $this->returnItemRepository->update($request->all(), $id);

        Flash::success('Return Item updated successfully.');

        return redirect(route('returns.show', [$returnItem->return_id]));
    }

    /**
     * Remove the specified ReturnItem from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        $returnItem = $this->returnItemRepository->find($id);

        if (empty($returnItem)) {
            Flash::error('Return Item not found');

            return redirect(route('returnItems.index'));
        }

        $this->returnItemRepository->delete($id);

        Flash::success('Return Item deleted successfully.');

        return redirect(route('returns.show', [$returnItem->return_id]));
    }
}
