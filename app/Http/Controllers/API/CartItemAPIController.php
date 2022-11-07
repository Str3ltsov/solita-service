<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCartItemAPIRequest;
use App\Http\Requests\API\UpdateCartItemAPIRequest;
use App\Models\CartItem;
use App\Repositories\CartItemRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CartItemController
 * @package App\Http\Controllers\API
 */

class CartItemAPIController extends AppBaseController
{
    /** @var  CartItemRepository */
    private $cartItemRepository;

    public function __construct(CartItemRepository $cartItemRepo)
    {
        $this->cartItemRepository = $cartItemRepo;
    }

    /**
     * Display a listing of the CartItem.
     * GET|HEAD /cartItems
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $cartItems = $this->cartItemRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($cartItems->toArray(), 'Cart Items retrieved successfully');
    }

    /**
     * Store a newly created CartItem in storage.
     * POST /cartItems
     *
     * @param CreateCartItemAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCartItemAPIRequest $request)
    {
        $input = $request->all();

        $cartItem = $this->cartItemRepository->create($input);

        return $this->sendResponse($cartItem->toArray(), 'Cart Item saved successfully');
    }

    /**
     * Display the specified CartItem.
     * GET|HEAD /cartItems/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var CartItem $cartItem */
        $cartItem = $this->cartItemRepository->find($id);

        if (empty($cartItem)) {
            return $this->sendError('Cart Item not found');
        }

        return $this->sendResponse($cartItem->toArray(), 'Cart Item retrieved successfully');
    }

    /**
     * Update the specified CartItem in storage.
     * PUT/PATCH /cartItems/{id}
     *
     * @param int $id
     * @param UpdateCartItemAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCartItemAPIRequest $request)
    {
        $input = $request->all();

        /** @var CartItem $cartItem */
        $cartItem = $this->cartItemRepository->find($id);

        if (empty($cartItem)) {
            return $this->sendError('Cart Item not found');
        }

        $cartItem = $this->cartItemRepository->update($input, $id);

        return $this->sendResponse($cartItem->toArray(), 'CartItem updated successfully');
    }

    /**
     * Remove the specified CartItem from storage.
     * DELETE /cartItems/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var CartItem $cartItem */
        $cartItem = $this->cartItemRepository->find($id);

        if (empty($cartItem)) {
            return $this->sendError('Cart Item not found');
        }

        $cartItem->delete();

        return $this->sendSuccess('Cart Item deleted successfully');
    }
}
