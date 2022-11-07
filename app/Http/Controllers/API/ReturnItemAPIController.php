<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateReturnItemAPIRequest;
use App\Http\Requests\API\UpdateReturnItemAPIRequest;
use App\Models\ReturnItem;
use App\Repositories\ReturnItemRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ReturnItemController
 * @package App\Http\Controllers\API
 */

class ReturnItemAPIController extends AppBaseController
{
    /** @var  ReturnItemRepository */
    private $returnItemRepository;

    public function __construct(ReturnItemRepository $returnItemRepo)
    {
        $this->returnItemRepository = $returnItemRepo;
    }

    /**
     * Display a listing of the ReturnItem.
     * GET|HEAD /returnItems
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $returnItems = $this->returnItemRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($returnItems->toArray(), 'Return Items retrieved successfully');
    }

    /**
     * Store a newly created ReturnItem in storage.
     * POST /returnItems
     *
     * @param CreateReturnItemAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateReturnItemAPIRequest $request)
    {
        $input = $request->all();

        $returnItem = $this->returnItemRepository->create($input);

        return $this->sendResponse($returnItem->toArray(), 'Return Item saved successfully');
    }

    /**
     * Display the specified ReturnItem.
     * GET|HEAD /returnItems/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ReturnItem $returnItem */
        $returnItem = $this->returnItemRepository->find($id);

        if (empty($returnItem)) {
            return $this->sendError('Return Item not found');
        }

        return $this->sendResponse($returnItem->toArray(), 'Return Item retrieved successfully');
    }

    /**
     * Update the specified ReturnItem in storage.
     * PUT/PATCH /returnItems/{id}
     *
     * @param int $id
     * @param UpdateReturnItemAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReturnItemAPIRequest $request)
    {
        $input = $request->all();

        /** @var ReturnItem $returnItem */
        $returnItem = $this->returnItemRepository->find($id);

        if (empty($returnItem)) {
            return $this->sendError('Return Item not found');
        }

        $returnItem = $this->returnItemRepository->update($input, $id);

        return $this->sendResponse($returnItem->toArray(), 'ReturnItem updated successfully');
    }

    /**
     * Remove the specified ReturnItem from storage.
     * DELETE /returnItems/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ReturnItem $returnItem */
        $returnItem = $this->returnItemRepository->find($id);

        if (empty($returnItem)) {
            return $this->sendError('Return Item not found');
        }

        $returnItem->delete();

        return $this->sendSuccess('Return Item deleted successfully');
    }
}
