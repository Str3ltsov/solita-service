<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCartStatusAPIRequest;
use App\Http\Requests\API\UpdateCartStatusAPIRequest;
use App\Models\CartStatus;
use App\Repositories\CartStatusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CartStatusController
 * @package App\Http\Controllers\API
 */

class CartStatusAPIController extends AppBaseController
{
    /** @var  CartStatusRepository */
    private $cartStatusRepository;

    public function __construct(CartStatusRepository $cartStatusRepo)
    {
        $this->cartStatusRepository = $cartStatusRepo;
    }

    /**
     * Display a listing of the CartStatus.
     * GET|HEAD /cartStatuses
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $cartStatuses = $this->cartStatusRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($cartStatuses->toArray(), 'Cart Statuses retrieved successfully');
    }

    /**
     * Store a newly created CartStatus in storage.
     * POST /cartStatuses
     *
     * @param CreateCartStatusAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCartStatusAPIRequest $request)
    {
        $input = $request->all();

        $cartStatus = $this->cartStatusRepository->create($input);

        return $this->sendResponse($cartStatus->toArray(), 'Cart Status saved successfully');
    }

    /**
     * Display the specified CartStatus.
     * GET|HEAD /cartStatuses/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var CartStatus $cartStatus */
        $cartStatus = $this->cartStatusRepository->find($id);

        if (empty($cartStatus)) {
            return $this->sendError('Cart Status not found');
        }

        return $this->sendResponse($cartStatus->toArray(), 'Cart Status retrieved successfully');
    }

    /**
     * Update the specified CartStatus in storage.
     * PUT/PATCH /cartStatuses/{id}
     *
     * @param int $id
     * @param UpdateCartStatusAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCartStatusAPIRequest $request)
    {
        $input = $request->all();

        /** @var CartStatus $cartStatus */
        $cartStatus = $this->cartStatusRepository->find($id);

        if (empty($cartStatus)) {
            return $this->sendError('Cart Status not found');
        }

        $cartStatus = $this->cartStatusRepository->update($input, $id);

        return $this->sendResponse($cartStatus->toArray(), 'CartStatus updated successfully');
    }

    /**
     * Remove the specified CartStatus from storage.
     * DELETE /cartStatuses/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var CartStatus $cartStatus */
        $cartStatus = $this->cartStatusRepository->find($id);

        if (empty($cartStatus)) {
            return $this->sendError('Cart Status not found');
        }

        $cartStatus->delete();

        return $this->sendSuccess('Cart Status deleted successfully');
    }
}
