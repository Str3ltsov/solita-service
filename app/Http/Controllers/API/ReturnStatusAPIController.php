<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateReturnStatusAPIRequest;
use App\Http\Requests\API\UpdateReturnStatusAPIRequest;
use App\Models\ReturnStatus;
use App\Repositories\ReturnStatusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ReturnStatusController
 * @package App\Http\Controllers\API
 */

class ReturnStatusAPIController extends AppBaseController
{
    /** @var  ReturnStatusRepository */
    private $returnStatusRepository;

    public function __construct(ReturnStatusRepository $returnStatusRepo)
    {
        $this->returnStatusRepository = $returnStatusRepo;
    }

    /**
     * Display a listing of the ReturnStatus.
     * GET|HEAD /returnStatuses
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $returnStatuses = $this->returnStatusRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($returnStatuses->toArray(), 'Return Statuses retrieved successfully');
    }

    /**
     * Store a newly created ReturnStatus in storage.
     * POST /returnStatuses
     *
     * @param CreateReturnStatusAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateReturnStatusAPIRequest $request)
    {
        $input = $request->all();

        $returnStatus = $this->returnStatusRepository->create($input);

        return $this->sendResponse($returnStatus->toArray(), 'Return Status saved successfully');
    }

    /**
     * Display the specified ReturnStatus.
     * GET|HEAD /returnStatuses/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ReturnStatus $returnStatus */
        $returnStatus = $this->returnStatusRepository->find($id);

        if (empty($returnStatus)) {
            return $this->sendError('Return Status not found');
        }

        return $this->sendResponse($returnStatus->toArray(), 'Return Status retrieved successfully');
    }

    /**
     * Update the specified ReturnStatus in storage.
     * PUT/PATCH /returnStatuses/{id}
     *
     * @param int $id
     * @param UpdateReturnStatusAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReturnStatusAPIRequest $request)
    {
        $input = $request->all();

        /** @var ReturnStatus $returnStatus */
        $returnStatus = $this->returnStatusRepository->find($id);

        if (empty($returnStatus)) {
            return $this->sendError('Return Status not found');
        }

        $returnStatus = $this->returnStatusRepository->update($input, $id);

        return $this->sendResponse($returnStatus->toArray(), 'ReturnStatus updated successfully');
    }

    /**
     * Remove the specified ReturnStatus from storage.
     * DELETE /returnStatuses/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ReturnStatus $returnStatus */
        $returnStatus = $this->returnStatusRepository->find($id);

        if (empty($returnStatus)) {
            return $this->sendError('Return Status not found');
        }

        $returnStatus->delete();

        return $this->sendSuccess('Return Status deleted successfully');
    }
}
